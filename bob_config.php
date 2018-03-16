<?php

namespace Bob\BuildConfig;

task('default', ['test', 'phpstan', 'sniff']);

desc('Run all tests');
task('test', ['phpunit', 'examples']);

desc('Run phpunit tests');
task('phpunit', function() {
    sh('phpunit', null, ['failOnError' => true]);
    println('Phpunit tests passed');
});

desc('Test examples');
task('examples', function() {
    sh('readme-tester test README.md', null, ['failOnError' => true]);
    println('Examples passed');
});

desc('Run statical analysis using phpstan');
task('phpstan', function() {
    sh('phpstan analyze -l 7 src', null, ['failOnError' => true]);
    println('Phpstan analysis passed');
});

desc('Run php code sniffer');
task('sniff', function() {
    sh('phpcs src --standard=PSR2', null, ['failOnError' => true]);
    println('Syntax checker on src/ passed');
});
