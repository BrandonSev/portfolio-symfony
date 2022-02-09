<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209112622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE technology (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, under_category_id INT NOT NULL, title VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, INDEX IDX_F463524D12469DE2 (category_id), INDEX IDX_F463524D6D8C4916 (under_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE technology ADD CONSTRAINT FK_F463524D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE technology ADD CONSTRAINT FK_F463524D6D8C4916 FOREIGN KEY (under_category_id) REFERENCES under_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE technology');
    }
}
