<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->name('*.php')
    ->exclude('somedir')
    ->notPath('src/DirectoryToExclude');

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@Symfony' => true,
    '@Symfony:risky' => true,
    'array_syntax' => ['syntax' => 'short'],
    'binary_operator_spaces' => [
        'default' => 'align_single_space_minimal',
    ],
    'concat_space' => ['spacing' => 'one'],
    'declare_strict_types' => true,
    'phpdoc_align' => ['align' => 'left'],
    'phpdoc_summary' => false,
    'return_type_declaration' => ['space_before' => 'none'],
    'not_operator_with_successor_space' => true,
    'trailing_comma_in_multiline' => ['elements' => ['arrays', 'arguments', 'parameters', 'match']],
    'phpdoc_to_comment' => false,
    'strict_comparison' => true,
    'strict_param' => true,
])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
