<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129003220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD image_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F68011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F68011AFE ON image (image_id_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C29C1004E');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C68011AFE');
        $this->addSql('DROP INDEX UNIQ_6A2CA10C68011AFE ON media');
        $this->addSql('DROP INDEX UNIQ_6A2CA10C29C1004E ON media');
        $this->addSql('ALTER TABLE media DROP image_id_id, DROP video_id');
        $this->addSql('ALTER TABLE video ADD video_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C29C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CC7DA2C29C1004E ON video (video_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C29C1004E');
        $this->addSql('DROP INDEX UNIQ_7CC7DA2C29C1004E ON video');
        $this->addSql('ALTER TABLE video DROP video_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F68011AFE');
        $this->addSql('DROP INDEX UNIQ_C53D045F68011AFE ON image');
        $this->addSql('ALTER TABLE image DROP image_id_id');
        $this->addSql('ALTER TABLE media ADD image_id_id INT DEFAULT NULL, ADD video_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C68011AFE FOREIGN KEY (image_id_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2CA10C68011AFE ON media (image_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2CA10C29C1004E ON media (video_id)');
    }
}
