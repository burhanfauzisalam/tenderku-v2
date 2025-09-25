<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/routes',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->exclude('vendor')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['default' => 'align_single_space_minimal'],
        'no_unused_imports' => true,
        'single_quote' => true,
        'trailing_comma_in_multiline' => true,
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => true,
        'braces' => ['position_after_functions_and_oop_constructs' => 'next'],
        'cast_spaces' => true,
        'concat_space' => ['spacing' => 'one'],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_indent' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_empty_return' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_var_without_name' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);