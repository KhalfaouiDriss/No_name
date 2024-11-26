<?php
// if (class_exists('ZipArchive')) {
//     echo "ZipArchive is enabled!";
// } else {
//     echo "ZipArchive is not enabled.";
// }

// function createZipFromFolder($folderPath, $outputZipPath) {
//     // تحقق من وجود المجلد
//     if (!is_dir($folderPath)) {
//         die("المجلد غير موجود: $folderPath");
//     }

//     $zip = new ZipArchive();

//     // افتح ملف الأرشيف الجديد
//     if ($zip->open($outputZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
//         die("تعذر إنشاء ملف ZIP");
//     }

//     // وظيفة لإضافة الملفات إلى الأرشيف
//     $files = new RecursiveIteratorIterator(
//         new RecursiveDirectoryIterator($folderPath),
//         RecursiveIteratorIterator::LEAVES_ONLY
//     );

//     foreach ($files as $file) {
//         // تخطي المجلدات
//         if (!$file->isDir()) {
//             $filePath = $file->getRealPath();
//             $relativePath = substr($filePath, strlen($folderPath) + 1);

//             // أضف الملف إلى الأرشيف
//             $zip->addFile($filePath, $relativePath);
//         }
//     }

//     // أغلق الأرشيف
//     $zip->close();

//     echo "تم إنشاء الأرشيف: $outputZipPath";
// }

// // المسار إلى مجلد العميل
// $clientFolder = '../stock/documents/test'; // ضع المسار الصحيح هنا
// $outputZip = '../stock/archive/test.zip'; // اسم ملف ZIP الناتج

// createZipFromFolder($clientFolder, $outputZip);



// اسم المجلد الذي تريد إنشاؤه
// $folderName = "ggg";

// $safeFolderName = escapeshellcmd($folderName);

// $command = "mkdir " . $safeFolderName;

// exec($command, $output, $returnVar);

// if ($returnVar === 0) {
//     echo "تم إنشاء المجلد بنجاح: $folderName";
// } else {
//     echo "حدث خطأ أثناء إنشاء المجلد.";
// }



$folderPath = realpath('../Stock/documents/test'); // مسار المجلد
$outputZipPath = realpath('../Stock/archive') . '/test.zip'; // مسار الأرشيف الناتج

if (!file_exists($folderPath)) {
    die("المجلد غير موجود: $folderPath");
}

// استدعاء سكربت Python
$command = escapeshellcmd("python3 archive.py $folderPath $outputZipPath");
$output = shell_exec($command);

echo "<pre>$output</pre>";
if (file_exists($outputZipPath)) {
    echo "تم إنشاء الأرشيف: $outputZipPath";
} else {
    echo "حدث خطأ أثناء إنشاء الأرشيف.";
}

?>
