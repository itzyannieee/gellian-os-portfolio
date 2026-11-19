<?php
require __DIR__ . '/../app/start.php';
requireAdmin();
require __DIR__ . '/layout.php';
$table = queryText('module');
$all = modules();
if (!isset($all[$table])) { http_response_code(404); exit('Unknown module.'); }
$fields = $all[$table];
$single = $table === 'profile';
$id = $single ? 1 : (int)queryText('id');
$base = 'records.php?module=' . $table;
$record = array_fill_keys(array_keys($fields), '');
if ($id > 0) {
    $find = $db->prepare("SELECT * FROM `$table` WHERE id=?"); $find->execute([$id]);
    $record = $find->fetch();
    if (!$record) { http_response_code(404); exit('Record not found.'); }
}
$error = '';
$imageField = $single ? 'portrait' : (isset($fields['image']) ? 'image' : null);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireToken();
    if (postText('action') === 'delete' && !$single && $id > 0) {
        $delete = $db->prepare("DELETE FROM `$table` WHERE id=?"); $delete->execute([$id]);
        if ($imageField) removeUnusedImage($db, $record[$imageField]);
        setNotice('Record deleted.'); go($base);
    }
    $values = [];
    $oldImage = $imageField ? $record[$imageField] : '';
    $newImage = null;
    try {
        foreach ($fields as $field => $max) {
            if ($field === $imageField) { $values[$field] = $oldImage; continue; }
            $value = postText($field);
            if (strlen($value) > $max) throw new InvalidArgumentException(ucfirst($field) . ' is too long.');
            $values[$field] = $value;
        }
        foreach (array_keys($fields) as $field) {
            if (in_array($field,['image','portrait','details','period','description','tags','issuer','intro_extra','github','facebook','instagram','linkedin'],true)) continue;
            if ($values[$field] === '') throw new InvalidArgumentException(str_replace('_',' ',$field) . ' is required.');
        }
        if ($single) {
            if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) throw new InvalidArgumentException('Enter a valid email address.');
            foreach (['github','facebook','instagram','linkedin'] as $key) {
                $url = $values[$key];
                if ($url !== '' && (!filter_var($url,FILTER_VALIDATE_URL) || !in_array(strtolower(parse_url($url,PHP_URL_SCHEME)),['http','https'],true))) throw new InvalidArgumentException('Use an HTTP or HTTPS address for ' . $key . '.');
            }
            if (!in_array($values['theme'],['light','dark'],true)) throw new InvalidArgumentException('Select light or dark.');
        }
        if ($table === 'projects') {
            $values['category'] = strtolower($values['category']);
            if (!preg_match('/^[a-z0-9][a-z0-9 -]{0,79}$/D',$values['category']) || $values['category']==='all') throw new InvalidArgumentException('Use a category such as design or development (not all).');
        }
        if ($imageField) {
            $newImage = uploadImage('picture');
            if ($newImage) $values[$imageField] = $newImage;
            elseif (postText('remove_picture') === 'yes') $values[$imageField] = '';
        }
        $columns = array_keys($fields);
        if ($id > 0) {
            $pairs = array_map(fn($column) => "`$column`=?", $columns);
            $save = $db->prepare("UPDATE `$table` SET " . implode(',',$pairs) . ' WHERE id=?');
            $save->execute([...array_values($values),$id]);
        } else {
            $names = '`' . implode('`,`',$columns) . '`';
            $marks = implode(',',array_fill(0,count($columns),'?'));
            $save = $db->prepare("INSERT INTO `$table` ($names) VALUES ($marks)");
            $save->execute(array_values($values));
        }
        if ($imageField && $oldImage !== $values[$imageField]) removeUnusedImage($db,$oldImage);
        setNotice('Changes saved.'); go($base);
    } catch (InvalidArgumentException $problem) { $error = $problem->getMessage(); $record = array_merge($record,$values); if ($imageField) $record[$imageField]=$oldImage; }
    catch (Throwable $problem) { if ($newImage) removeUnusedImage($db,$newImage); throw $problem; }
}
adminTop(ucwords(str_replace('_',' ',$table)));
if ($error): ?><p class="error" role="alert"><?= h($error) ?></p><?php endif; ?>
<div class="record-layout <?= $single ? 'wide' : '' ?>"><section class="panel"><h2><?= $single ? 'Edit public profile' : ($id ? 'Edit record #' . $id : 'Add new record') ?></h2><form action="<?= h($base . ($id ? '&id='.$id : '')) ?>" method="post" enctype="multipart/form-data"><?= csrfField() ?><input type="hidden" name="action" value="save"><div class="fields"><?php foreach ($fields as $field=>$max): if ($field === $imageField) continue; ?><label><?= h(ucfirst(str_replace('_',' ',$field))) ?><?php if ($field === 'theme'): ?><select name="theme"><option value="light" <?= $record[$field]==='light'?'selected':'' ?>>Light</option><option value="dark" <?= $record[$field]==='dark'?'selected':'' ?>>Dark</option></select><?php elseif ($max>=500): ?><textarea name="<?= h($field) ?>" maxlength="<?= $max ?>" rows="4"><?= h($record[$field]) ?></textarea><?php else: ?><input name="<?= h($field) ?>" maxlength="<?= $max ?>" value="<?= h($record[$field]) ?>"><?php endif; ?></label><?php endforeach; ?></div><?php if ($imageField): ?><label>Image (JPG/PNG, max 5 MB)<input type="file" name="picture" accept="image/jpeg,image/png"></label><?php if ($record[$imageField]): ?><img class="preview" src="../<?= h(imageLink($record[$imageField])) ?>" alt="Current image"><label class="inline"><input type="checkbox" name="remove_picture" value="yes"> Remove current image</label><?php endif; ?><?php endif; ?><?php if ($table==='projects'): ?><p class="muted">Separate technology tags with |, for example HTML | CSS | 2026.</p><?php endif; ?><button>Save changes</button> <?php if (!$single && $id): ?><a href="<?= h($base) ?>">Cancel editing</a><?php endif; ?></form></section>
<?php if (!$single): ?><section class="panel"><h2>Saved records</h2><?php $records=getRows($db,$table); if (!$records): ?><p>No records yet.</p><?php endif; ?><?php foreach ($records as $row): ?><article class="record"><div><strong><?= h($row[array_key_first($fields)]) ?></strong><small>Record #<?= (int)$row['id'] ?></small></div><div class="actions"><a href="<?= h($base.'&id='.$row['id']) ?>">Edit</a><form method="post" action="<?= h($base.'&id='.$row['id']) ?>" onsubmit="return confirm('Delete this record?')"><?= csrfField() ?><input type="hidden" name="action" value="delete"><button class="danger">Delete</button></form></div></article><?php endforeach; ?></section><?php endif; ?></div><?php adminBottom(); ?>
