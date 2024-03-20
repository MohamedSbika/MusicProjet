<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228202017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE titre_artiste DROP FOREIGN KEY FK_E71CBD6D21D25844');
        $this->addSql('ALTER TABLE titre_artiste DROP FOREIGN KEY FK_E71CBD6DD54FAE5E');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE titre');
        $this->addSql('DROP TABLE titre_artiste');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, nomartiste VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, datenaissance DATETIME NOT NULL, datedeces DATETIME DEFAULT NULL, imgartiste VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE titre (id INT AUTO_INCREMENT NOT NULL, nomtitre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATE NOT NULL, imgtitre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lien VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE titre_artiste (titre_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_E71CBD6DD54FAE5E (titre_id), INDEX IDX_E71CBD6D21D25844 (artiste_id), PRIMARY KEY(titre_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE titre_artiste ADD CONSTRAINT FK_E71CBD6D21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE titre_artiste ADD CONSTRAINT FK_E71CBD6DD54FAE5E FOREIGN KEY (titre_id) REFERENCES titre (id) ON DELETE CASCADE');
    }
}
