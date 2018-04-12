<?php

namespace Bob\BuildConfig;

task('default', ['build_formats', 'test', 'phpstan', 'sniff']);

desc('Run all tests');
task('test', ['phpunit', 'examples']);

desc('Run phpunit tests');
task('phpunit', function() {
    sh('phpunit', null, ['failOnError' => true]);
    println('Phpunit tests passed');
});

desc('Test examples');
task('examples', function() {
    sh('readme-tester README.md', null, ['failOnError' => true]);
    println('Examples passed');
});

desc('Run statical analysis using phpstan');
task('phpstan', function() {
    sh('phpstan analyze -l 7 src', null, ['failOnError' => true]);
    println('Phpstan analysis passed');
});

desc('Run php code sniffer');
task('sniff', function() {
    sh('phpcs src --standard=PSR2 --ignore=src/Format/Build/*', null, ['failOnError' => true]);
    println('Syntax checker on src/ passed');
    sh('phpcs tests --standard=PSR2 --ignore=tests/Format/Build/*', null, ['failOnError' => true]);
    println('Syntax checker on tests/ passed');
});

desc('Build formats');
task('build_formats', ['src/Format/FormatFactory.php']);

fileTask('src/Format/FormatFactory.php', ['dev/formats.json'], function() {
    sh('php dev/build_formats.php ', null, ['failOnError' => true]);
});
