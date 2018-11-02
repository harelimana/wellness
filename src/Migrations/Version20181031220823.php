<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181031220823 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, localite VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, codepostal_id INT NOT NULL, localite_id INT NOT NULL, commune_id INT NOT NULL, address_number VARCHAR(16) NOT NULL, address_rue VARCHAR(32) NOT NULL, email VARCHAR(32) NOT NULL, banni TINYINT(1) NOT NULL, inscription TINYINT(1) NOT NULL, inscription_date DATETIME DEFAULT NULL, password VARCHAR(32) NOT NULL, success_attempt INT DEFAULT NULL, discr VARCHAR(255) NOT NULL, INDEX IDX_8D93D649C9B1D722 (codepostal_id), INDEX IDX_8D93D649924DD2B5 (localite_id), INDEX IDX_8D93D649131A4F72 (commune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code_postal (id INT AUTO_INCREMENT NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, no_id INT DEFAULT NULL, prestataire_id INT NOT NULL, affichage_debut DATETIME NOT NULL, affichage_fin DATETIME NOT NULL, debut_stage DATETIME NOT NULL, fin_stage DATETIME NOT NULL, description VARCHAR(128) NOT NULL, more_info VARCHAR(64) DEFAULT NULL, name VARCHAR(45) NOT NULL, tarif VARCHAR(45) NOT NULL, INDEX IDX_C27C93691A65C546 (no_id), INDEX IDX_C27C9369BE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, description VARCHAR(64) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_id INT DEFAULT NULL, logo_id INT NOT NULL, name VARCHAR(45) NOT NULL, telnumber INT DEFAULT NULL, tvanumber INT NOT NULL, website VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_60A26480A76ED395 (user_id), UNIQUE INDEX UNIQ_60A264803DA5256D (image_id), UNIQUE INDEX UNIQ_60A26480F98F144A (logo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, prestataire_id INT NOT NULL, name VARCHAR(45) NOT NULL, en_avant TINYINT(1) NOT NULL, valide TINYINT(1) NOT NULL, description VARCHAR(128) DEFAULT NULL, UNIQUE INDEX UNIQ_E19D9AD23DA5256D (image_id), INDEX IDX_E19D9AD2BE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, commune VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(45) DEFAULT NULL, ordre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internaute (id INT NOT NULL, firstname VARCHAR(45) DEFAULT NULL, lastname VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internaute_bloc (internaute_id INT NOT NULL, bloc_id INT NOT NULL, INDEX IDX_B4CC2BA7CAF41882 (internaute_id), INDEX IDX_B4CC2BA75582E9C0 (bloc_id), PRIMARY KEY(internaute_id, bloc_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C9B1D722 FOREIGN KEY (codepostal_id) REFERENCES code_postal (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C93691A65C546 FOREIGN KEY (no_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A264803DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480F98F144A FOREIGN KEY (logo_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD23DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CCBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internaute_bloc ADD CONSTRAINT FK_B4CC2BA7CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE internaute_bloc ADD CONSTRAINT FK_B4CC2BA75582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649924DD2B5');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480A76ED395');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CCBF396750');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C9B1D722');
        $this->addSql('ALTER TABLE internaute_bloc DROP FOREIGN KEY FK_B4CC2BA75582E9C0');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C93691A65C546');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369BE3DB2B7');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2BE3DB2B7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649131A4F72');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A264803DA5256D');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480F98F144A');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD23DA5256D');
        $this->addSql('ALTER TABLE internaute_bloc DROP FOREIGN KEY FK_B4CC2BA7CAF41882');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE code_postal');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE bloc');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE internaute');
        $this->addSql('DROP TABLE internaute_bloc');
    }
}
