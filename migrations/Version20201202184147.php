<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202184147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, synopsis LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, title_id INT NOT NULL, number INT NOT NULL, year INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_F0E45BA9A9F87BD (title_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season_program (season_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_B794DEDA4EC001D1 (season_id), INDEX IDX_B794DEDA3EB8070A (program_id), PRIMARY KEY(season_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9A9F87BD FOREIGN KEY (title_id) REFERENCES episode (id)');
        $this->addSql('ALTER TABLE season_program ADD CONSTRAINT FK_B794DEDA4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE season_program ADD CONSTRAINT FK_B794DEDA3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program ADD country VARCHAR(255) NOT NULL, ADD year INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9A9F87BD');
        $this->addSql('ALTER TABLE season_program DROP FOREIGN KEY FK_B794DEDA4EC001D1');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE season_program');
        $this->addSql('ALTER TABLE program DROP country, DROP year');
    }
}
