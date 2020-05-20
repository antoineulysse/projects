<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415134903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('ALTER TABLE adresse CHANGE numero_rue numero_rue VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD photo LONGBLOB DEFAULT NULL, CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE content content VARCHAR(255) DEFAULT NULL');
        // $this->addSql('ALTER TABLE comments CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE person RENAME INDEX fk_adresse TO IDX_34DCD1764DE7DC5C');
        // $this->addSql('ALTER TABLE liker RENAME INDEX idx_ac6340b379f37ae5 TO IDX_3ECD7EEB79F37AE5');
        // $this->addSql('ALTER TABLE liker RENAME INDEX idx_ac6340b39514aa5c TO IDX_3ECD7EEB9514AA5C');
        // $this->addSql('ALTER TABLE image CHANGE ad_id ad_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse CHANGE numero_rue numero_rue VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comments CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE ad_id ad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liker RENAME INDEX idx_3ecd7eeb79f37ae5 TO IDX_AC6340B379F37AE5');
        $this->addSql('ALTER TABLE liker RENAME INDEX idx_3ecd7eeb9514aa5c TO IDX_AC6340B39514AA5C');
        $this->addSql('ALTER TABLE person RENAME INDEX idx_34dcd1764de7dc5c TO FK_ADRESSE');
        $this->addSql('ALTER TABLE post DROP photo, CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE content content VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
