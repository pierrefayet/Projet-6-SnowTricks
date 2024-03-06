# Snowtrick

![Build Status](https://insight.symfony.com/projects/5710005b-a1dc-41f8-8e29-943a51f26fcf/big.svg)

## Description

Welcome to snowtrick, a dynamic community hub designed for snowboard enthusiasts and adrenaline seekers. This platform
celebrates the world of snowboarding by offering a space dedicated to sharing, learning and discussing all kinds of
snowboard tricks.

Whether you're a beginner looking to pull off your first trick, an experienced rider looking to hone your technique, or
a passionate fan wanting to connect with others who share your love of snowboarding, snowtrick offers a comprehensive
resource. Here you can explore a wide range of snowboarding tips, detailed tutorials and personal experiences shared by
community members.

Our mission is to foster a supportive environment where snowboarders of all levels can improve their skills, share their
passion and grow together. Join us to discover new tricks, share your achievements and be part of a community that lives
and breathes snowboarding.

## Features

- post snowboard tricks
- comment on snowboard tricks
- secure connection system
- snowboard tricks gallery with tutorials posted by members
- user profile customization

## Technologies Used

- Symfony 6.4
- PHP 8
- MySQL
- Mailer
- knp paginator
- Webpack Encore

## Installation

```bash
git clone https://github.com/pierrefayet/prjet-6-SnowTricks.git
cd yourproject
composer install
npm install
npm run build
# Configure .env with your database information
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
# Starting the Symfony server
symfony server:start
```

## Utilisation

After installation, open your browser and go to https://localhost:8000 to see the application in action. You can create
an account, post figures, comment and personalize your profile.

## Contribution

Contributions are what make the open source community a place of learning, inspiration and creativity. We encourage
contributions large and small.
