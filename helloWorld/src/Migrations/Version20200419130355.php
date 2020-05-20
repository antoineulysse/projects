<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200419130355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

      //  $this->addSql('CREATE TABLE notification_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, notification_id INT DEFAULT NULL, is_viewed TINYINT(1) NOT NULL, INDEX IDX_35AF9D73A76ED395 (user_id), INDEX IDX_35AF9D73EF1A9D84 (notification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE notification_user ADD CONSTRAINT FK_35AF9D73A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
       // $this->addSql('ALTER TABLE notification_user ADD CONSTRAINT FK_35AF9D73EF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id)');
        $this->addSql('ALTER TABLE adresse CHANGE numero_rue numero_rue VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE content content VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comments CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
       // $this->addSql('ALTER TABLE person RENAME INDEX fk_adresse TO IDX_34DCD1764DE7DC5C');
       // $this->addSql('ALTER TABLE liker RENAME INDEX idx_ac6340b379f37ae5 TO IDX_3ECD7EEB79F37AE5');
        $this->addSql('ALTER TABLE notification ADD comments_id INT DEFAULT NULL, ADD liker_id INT DEFAULT NULL, CHANGE post_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA63379586 FOREIGN KEY (comments_id) REFERENCES comments (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA979F103A FOREIGN KEY (liker_id) REFERENCES liker (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF5476CA63379586 ON notification (comments_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF5476CA979F103A ON notification (liker_id)');
        $this->addSql('ALTER TABLE image CHANGE ad_id ad_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE notification_user');
        $this->addSql('ALTER TABLE adresse CHANGE numero_rue numero_rue VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comments CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_post_id id_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE ad_id ad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liker RENAME INDEX idx_3ecd7eeb79f37ae5 TO IDX_AC6340B379F37AE5');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA63379586');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA979F103A');
        $this->addSql('DROP INDEX UNIQ_BF5476CA63379586 ON notification');
        $this->addSql('DROP INDEX UNIQ_BF5476CA979F103A ON notification');
        $this->addSql('ALTER TABLE notification DROP comments_id, DROP liker_id, CHANGE post_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person RENAME INDEX idx_34dcd1764de7dc5c TO FK_ADRESSE');
        $this->addSql('ALTER TABLE post CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE content content VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
