<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818101320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE todo_bun (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, task VARCHAR(255) NOT NULL, importance INTEGER NOT NULL, completed BOOLEAN NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, task, importance, completed FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, task VARCHAR(255) NOT NULL COLLATE BINARY, completed BOOLEAN NOT NULL, importance BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO todo (id, task, importance, completed) SELECT id, task, importance, completed FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE todo_bun');
        $this->addSql('CREATE TEMPORARY TABLE __temp__todo AS SELECT id, task, importance, completed FROM todo');
        $this->addSql('DROP TABLE todo');
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, task VARCHAR(255) NOT NULL, completed BOOLEAN NOT NULL, importance INTEGER NOT NULL)');
        $this->addSql('INSERT INTO todo (id, task, importance, completed) SELECT id, task, importance, completed FROM __temp__todo');
        $this->addSql('DROP TABLE __temp__todo');
    }
}
