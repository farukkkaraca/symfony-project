<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904094302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE urun DROP FOREIGN KEY FK_D292F260F89C2B38');
        $this->addSql('ALTER TABLE urun ADD CONSTRAINT FK_D292F260F89C2B38 FOREIGN KEY (kategori_id) REFERENCES kategori (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE urun DROP FOREIGN KEY FK_D292F260F89C2B38');
        $this->addSql('ALTER TABLE urun ADD CONSTRAINT FK_D292F260F89C2B38 FOREIGN KEY (kategori_id) REFERENCES kategori (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
