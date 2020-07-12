<?php

// On arrête le script 3 secondes
// sleep(3);

$sentences = [
    'Hello world!',
    'Great server',
    'Amazing ajax request',
    'A random sentence',
    'Sentence generator'
];

echo $sentences[array_rand($sentences)];
