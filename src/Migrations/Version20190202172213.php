<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190202172213 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE videos (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, thumbnail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bible (id INT AUTO_INCREMENT NOT NULL, book VARCHAR(255) NOT NULL, chapter INT NOT NULL, verse INT NOT NULL, word LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE The_Holy_Scriptures');
        $this->addSql('ALTER TABLE RECENT_HYMNS2 CHANGE POPULARITY POPULARITY INT NOT NULL');
        $this->addSql('ALTER TABLE RECENT_HYMNS CHANGE POPULARITY POPULARITY INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE The_Holy_Scriptures (id INT AUTO_INCREMENT NOT NULL, bookID INT DEFAULT NULL, book TEXT DEFAULT NULL COLLATE latin1_swedish_ci, chapter INT DEFAULT NULL, verse INT DEFAULT NULL, word TEXT DEFAULT NULL COLLATE latin1_swedish_ci, image TEXT DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE videos');
        $this->addSql('DROP TABLE bible');
        $this->addSql('ALTER TABLE RECENT_HYMNS CHANGE POPULARITY POPULARITY INT DEFAULT 0');
        $this->addSql('ALTER TABLE RECENT_HYMNS2 CHANGE POPULARITY POPULARITY INT DEFAULT 0 NOT NULL');
    }
}
