<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428121126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_chambre CHANGE chambre_id chambre_id INT DEFAULT NULL, CHANGE prix_id prix_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse CHANGE numero_rue numero_rue INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED94DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE INDEX IDX_3535ED94DE7DC5C ON hotel (adresse_id)');
        $this->addSql('ALTER TABLE caracteristique_hotel CHANGE hotel_id hotel_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse CHANGE numero_rue numero_rue INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caracteristique_hotel CHANGE hotel_id hotel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED94DE7DC5C');
        $this->addSql('DROP INDEX IDX_3535ED94DE7DC5C ON hotel');
        $this->addSql('ALTER TABLE hotel DROP adresse_id');
        $this->addSql('ALTER TABLE type_chambre CHANGE chambre_id chambre_id INT DEFAULT NULL, CHANGE prix_id prix_id INT DEFAULT NULL');
    }
}
