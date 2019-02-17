<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190217025625 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE SCHEDULE_EGW DROP FOREIGN KEY FK_FD496A02D30CCB8');
        $this->addSql('CREATE TABLE 1BC (BOOKCODE VARCHAR(255) DEFAULT NULL, PAGE INT DEFAULT NULL, PARAGRAPH INT DEFAULT NULL, WORD TEXT DEFAULT NULL, ID INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE 1MCP (BOOKCODE VARCHAR(255) DEFAULT NULL, PAGE INT DEFAULT NULL, PARAGRAPH INT DEFAULT NULL, WORD TEXT DEFAULT NULL, ID INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE 1SM (BOOKCODE VARCHAR(255) DEFAULT NULL, PAGE INT DEFAULT NULL, PARAGRAPH INT DEFAULT NULL, WORD TEXT DEFAULT NULL, ID INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE 1SP (BOOKCODE VARCHAR(255) DEFAULT NULL, PAGE INT DEFAULT NULL, PARAGRAPH INT DEFAULT NULL, WORD TEXT DEFAULT NULL, ID INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE 1T (BOOKCODE VARCHAR(255) DEFAULT NULL, PAGE INT DEFAULT NULL, PARAGRAPH INT DEFAULT NULL, WORD TEXT DEFAULT NULL, ID INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE 1SG (BOOKCODE VARCHAR(255) DEFAULT NULL, PAGE INT DEFAULT NULL, PARAGRAPH INT DEFAULT NULL, WORD TEXT DEFAULT NULL, ID INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblebooks (bookID INT AUTO_INCREMENT NOT NULL, book TEXT DEFAULT NULL, chapters INT DEFAULT NULL, verses INT DEFAULT NULL, startDate DATE DEFAULT NULL, PRIMARY KEY(bookID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE EGWbooks');
        $this->addSql('ALTER TABLE SCHEDULE_EGW DROP FOREIGN KEY FK_FD496A02D30CCB8');
        $this->addSql('ALTER TABLE SCHEDULE_EGW ADD CONSTRAINT FK_FD496A02D30CCB8 FOREIGN KEY (BOOKCODE) REFERENCES books (bookCode)');
        $this->addSql('ALTER TABLE mindcharacterpersonality1 CHANGE word word VARCHAR(65000) DEFAULT NULL');
        $this->addSql('ALTER TABLE ministryofhealing CHANGE word word VARCHAR(65000) DEFAULT NULL');
        $this->addSql('ALTER TABLE books MODIFY bookID INT NOT NULL');
        $this->addSql('ALTER TABLE books DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE books ADD bookmark INT DEFAULT NULL, ADD id INT DEFAULT NULL, ADD bookCode VARCHAR(255) NOT NULL, ADD bookTitle VARCHAR(255) DEFAULT NULL, ADD creation_date DATETIME DEFAULT NULL, ADD totalparagraphs INT DEFAULT NULL, ADD display_status VARCHAR(255) NOT NULL, DROP bookID, DROP book, DROP chapters, DROP verses, DROP startDate');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92DA62921D FOREIGN KEY (bookmark) REFERENCES DA (ID)');
        $this->addSql('CREATE INDEX bookmark ON books (bookmark)');
        $this->addSql('ALTER TABLE books ADD PRIMARY KEY (bookCode)');
        $this->addSql('ALTER TABLE mindcharacterpersonality2 CHANGE word word VARCHAR(65000) DEFAULT NULL');
        $this->addSql('ALTER TABLE education CHANGE word word VARCHAR(65000) DEFAULT NULL');
        $this->addSql('ALTER TABLE childguidance CHANGE word word VARCHAR(65000) DEFAULT NULL');
        $this->addSql('ALTER TABLE egwTitles CHANGE bookCode bookCode VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE egw_writings CHANGE word word VARCHAR(65000) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE EGWbooks (bookmark INT DEFAULT NULL, id INT DEFAULT NULL, bookCode VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, bookTitle VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, creation_date DATETIME DEFAULT NULL, totalparagraphs INT DEFAULT NULL, INDEX bookmark (bookmark), PRIMARY KEY(bookCode)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE EGWbooks ADD CONSTRAINT FK_1841BDD7DA62921D FOREIGN KEY (bookmark) REFERENCES DA (ID)');
        $this->addSql('DROP TABLE 1BC');
        $this->addSql('DROP TABLE 1MCP');
        $this->addSql('DROP TABLE 1SM');
        $this->addSql('DROP TABLE 1SP');
        $this->addSql('DROP TABLE 1T');
        $this->addSql('DROP TABLE 1SG');
        $this->addSql('DROP TABLE biblebooks');
        $this->addSql('ALTER TABLE SCHEDULE_EGW DROP FOREIGN KEY FK_FD496A02D30CCB8');
        $this->addSql('ALTER TABLE SCHEDULE_EGW ADD CONSTRAINT FK_FD496A02D30CCB8 FOREIGN KEY (BOOKCODE) REFERENCES EGWbooks (bookCode)');
        $this->addSql('ALTER TABLE books MODIFY bookCode VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A92DA62921D');
        $this->addSql('DROP INDEX bookmark ON books');
        $this->addSql('ALTER TABLE books DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE books ADD bookID INT AUTO_INCREMENT NOT NULL, ADD book TEXT DEFAULT NULL COLLATE latin1_swedish_ci, ADD chapters INT DEFAULT NULL, ADD verses INT DEFAULT NULL, ADD startDate DATE DEFAULT NULL, DROP bookmark, DROP id, DROP bookCode, DROP bookTitle, DROP creation_date, DROP totalparagraphs, DROP display_status');
        $this->addSql('ALTER TABLE books ADD PRIMARY KEY (bookID)');
        $this->addSql('ALTER TABLE childguidance CHANGE word word MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE education CHANGE word word MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE egwTitles CHANGE bookCode bookCode VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE egw_writings CHANGE word word MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE mindcharacterpersonality1 CHANGE word word MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE mindcharacterpersonality2 CHANGE word word MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE ministryofhealing CHANGE word word MEDIUMTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
