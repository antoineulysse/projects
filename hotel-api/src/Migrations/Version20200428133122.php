<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428133122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prix ADD tarif INT NOT NULL');
        $this->addSql('ALTER TABLE type_chambre CHANGE chambre_id chambre_id INT DEFAULT NULL, CHANGE prix_id prix_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08163243BB18');
        $this->addSql('DROP INDEX IDX_C35F08163243BB18 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP hotel_id, CHANGE numero_rue numero_rue INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE adresse_id adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caracteristique_hotel CHANGE hotel_id hotel_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse ADD hotel_id INT NOT NULL, CHANGE numero_rue numero_rue INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08163243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_C35F08163243BB18 ON adresse (hotel_id)');
        $this->addSql('ALTER TABLE caracteristique_hotel CHANGE hotel_id hotel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE adresse_id adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prix DROP tarif');
        $this->addSql('ALTER TABLE type_chambre CHANGE chambre_id chambre_id INT DEFAULT NULL, CHANGE prix_id prix_id INT DEFAULT NULL');
    }
}
