<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129191522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F68011AFE');
        $this->addSql('ALTER TABLE image ADD alt VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F68011AFE FOREIGN KEY (image_id_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE media DROP type, DROP alt');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C29C1004E');
        $this->addSql('DROP INDEX UNIQ_7CC7DA2C29C1004E ON video');
        $this->addSql('ALTER TABLE video DROP video_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video ADD video_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CC7DA2C29C1004E ON video (video_id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F68011AFE');
        $this->addSql('ALTER TABLE image DROP alt');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F68011AFE FOREIGN KEY (image_id_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE media ADD type VARCHAR(50) DEFAULT NULL, ADD alt VARCHAR(50) DEFAULT NULL');
    }
}
