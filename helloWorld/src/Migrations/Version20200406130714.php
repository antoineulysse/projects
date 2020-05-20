<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200406130714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    
        $this->addSql('ALTER TABLE post CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE content content VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comments CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
       
        $this->addSql('ALTER TABLE `like` CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse CHANGE numero_rue numero_rue VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comments CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `like` CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person RENAME INDEX idx_34dcd1764de7dc5c TO FK_ADRESSE');
        $this->addSql('ALTER TABLE post CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE content content VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
