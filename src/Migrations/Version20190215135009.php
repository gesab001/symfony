<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215135009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE TopTenTopics DROP FOREIGN KEY TopTenTopics_ibfk_1');
        $this->addSql('ALTER TABLE TopTenTopicsReference DROP FOREIGN KEY TopTenTopicsReference_ibfk_1');
        $this->addSql('CREATE TABLE egw (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sabbath (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, biblereference VARCHAR(255) NOT NULL, word LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, document_file_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE Employee3');
        $this->addSql('DROP TABLE The_Holy_Scriptures');
        $this->addSql('DROP TABLE TopTen');
        $this->addSql('DROP TABLE TopTenTopics');
        $this->addSql('DROP TABLE TopTenTopicsReference');
        $this->addSql('DROP TABLE test');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Employee3 (EmpID INT NOT NULL, Name VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE The_Holy_Scriptures (id INT AUTO_INCREMENT NOT NULL, bookID INT DEFAULT NULL, book TEXT DEFAULT NULL COLLATE latin1_swedish_ci, chapter INT DEFAULT NULL, verse INT DEFAULT NULL, word TEXT DEFAULT NULL COLLATE latin1_swedish_ci, image TEXT DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE TopTen (id INT AUTO_INCREMENT NOT NULL, subject TEXT DEFAULT NULL COLLATE latin1_swedish_ci, tableName TEXT DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE TopTenTopics (Id INT AUTO_INCREMENT NOT NULL, Topic VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, Notes TEXT DEFAULT NULL COLLATE latin1_swedish_ci, SubjectID INT NOT NULL, UNIQUE INDEX Topic (Topic), INDEX SubjectID (SubjectID), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE TopTenTopicsReference (Id INT AUTO_INCREMENT NOT NULL, TopicId INT DEFAULT NULL, Book TEXT NOT NULL COLLATE latin1_swedish_ci, Chapter INT NOT NULL, VerseStart INT NOT NULL, VerseEnd INT DEFAULT NULL, INDEX TopicId (TopicId), PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE test (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE TopTenTopics ADD CONSTRAINT TopTenTopics_ibfk_1 FOREIGN KEY (SubjectID) REFERENCES TopTen (id)');
        $this->addSql('ALTER TABLE TopTenTopicsReference ADD CONSTRAINT TopTenTopicsReference_ibfk_1 FOREIGN KEY (TopicId) REFERENCES TopTenTopics (Id)');
        $this->addSql('DROP TABLE egw');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE sabbath');
        $this->addSql('DROP TABLE document');
    }
}
