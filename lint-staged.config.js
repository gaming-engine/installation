module.exports = {
  'resources/**/*.{css}': ['prettier --write'],
  'resources/**/*.{js,vue}': ['eslint --no-ignore --color'],
  '**/*.php': [
    'php ./vendor/bin/php-cs-fixer fix --config .php-cs-fixer.php --allow-risky=yes',
  ],
};
