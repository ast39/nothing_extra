## Storage module manual

---
##### Include
    use modules\storage\Storage;
---

##### Settings
>Open file: modules\storage\cfg.php

    return [
        'test' => 'app.public.test',
    ];
---

##### Check for exist
    Storage::disk('public')->exists('test')
---

##### Get data from storage
    $data = Storage::disk('public')->get('test')
---

##### Get data from storage as text
    $data = Storage::disk('public')->get('test')->toText()
---

##### Get data from storage as array
    $data = Storage::disk('public')->get('test')->toArray()
---

##### Get data from storage as array of objects
    $data = Storage::disk('public')->get('test')->toArrayOfObjects()
---

##### Get data from storage as Json object
    $data = Storage::disk('public')->get('test')->toJson()
---

##### Save data into the storage
    Storage::disk('public')->put('test', json_encode(['name' => 'John', 'surname'=> 'Smith']));
---

##### Append data into the storage
    Storage::disk('public')->append('test', json_encode(['name' => 'John', 'surname'=> 'Smith']));
---

##### Delete data from the storage
    Storage::disk('public')->delete('test');
---