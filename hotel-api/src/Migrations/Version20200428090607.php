<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428090607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_chambre (id INT AUTO_INCREMENT NOT NULL, chambre_id INT DEFAULT NULL, prix_id INT DEFAULT NULL, capacite VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_ED288B0A9B177F54 (chambre_id), INDEX IDX_ED288B0A944722F2 (prix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, hotel_id INT NOT NULL, numero_rue INT DEFAULT NULL, nom_rue VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, pays VARCHAR(100) NOT NULL, INDEX IDX_C35F08163243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, nom_hotel VARCHAR(255) NOT NULL, nombre_etoile VARCHAR(255) NOT NULL, numero_telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique_hotel (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, parking TINYINT(1) NOT NULL, bar TINYINT(1) NOT NULL, climatiseur TINYINT(1) NOT NULL, restaurant TINYINT(1) NOT NULL, petit_dejeuner TINYINT(1) NOT NULL, INDEX IDX_1DD7F7473243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, hotel_id INT NOT NULL, television TINYINT(1) NOT NULL, internet TINYINT(1) NOT NULL, photo_chambre LONGBLOB DEFAULT NULL, INDEX IDX_C509E4FF3243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_chambre ADD CONSTRAINT FK_ED288B0A9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('ALTER TABLE type_chambre ADD CONSTRAINT FK_ED288B0A944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08163243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE caracteristique_hotel ADD CONSTRAINT FK_1DD7F7473243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_chambre DROP FOREIGN KEY FK_ED288B0A944722F2');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08163243BB18');
        $this->addSql('ALTER TABLE caracteristique_hotel DROP FOREIGN KEY FK_1DD7F7473243BB18');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF3243BB18');
        $this->addSql('ALTER TABLE type_chambre DROP FOREIGN KEY FK_ED288B0A9B177F54');
        $this->addSql('DROP TABLE prix');
        $this->addSql('DROP TABLE type_chambre');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE caracteristique_hotel');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE chambre');
    }
}
