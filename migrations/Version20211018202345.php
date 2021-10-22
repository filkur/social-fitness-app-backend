<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018202345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Comment (id UUID NOT NULL, owner_id UUID NOT NULL, post_id UUID NOT NULL, content VARCHAR(200) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5BC96BF07E3C61F9 ON Comment (owner_id)');
        $this->addSql('CREATE INDEX IDX_5BC96BF04B89032C ON Comment (post_id)');
        $this->addSql('COMMENT ON COLUMN Comment.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Comment.owner_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Comment.post_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Comment.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE Post (id UUID NOT NULL, group_id UUID DEFAULT NULL, owner_id UUID NOT NULL, content VARCHAR(400) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FAB8C3B3FE54D947 ON Post (group_id)');
        $this->addSql('CREATE INDEX IDX_FAB8C3B37E3C61F9 ON Post (owner_id)');
        $this->addSql('COMMENT ON COLUMN Post.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Post.group_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Post.owner_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN Post.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN Post.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE group_member (id UUID NOT NULL, user_id UUID DEFAULT NULL, group_id UUID NOT NULL, assigned_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A36222A8A76ED395 ON group_member (user_id)');
        $this->addSql('CREATE INDEX IDX_A36222A8FE54D947 ON group_member (group_id)');
        $this->addSql('COMMENT ON COLUMN group_member.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN group_member.user_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN group_member.group_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN group_member.assigned_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE groups (id UUID NOT NULL, owner_id UUID DEFAULT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(200) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F06D39707E3C61F9 ON groups (owner_id)');
        $this->addSql('COMMENT ON COLUMN groups.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN groups.owner_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN groups.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN groups.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE invitation (id UUID NOT NULL, group_id UUID DEFAULT NULL, code VARCHAR(8) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F11D61A2FE54D947 ON invitation (group_id)');
        $this->addSql('COMMENT ON COLUMN invitation.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN invitation.group_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN invitation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN invitation.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, nickname VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, email VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9A188FE64 ON users (nickname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN users.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN users.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF07E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Comment ADD CONSTRAINT FK_5BC96BF04B89032C FOREIGN KEY (post_id) REFERENCES Post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B3FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B37E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_member ADD CONSTRAINT FK_A36222A8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE group_member ADD CONSTRAINT FK_A36222A8FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groups ADD CONSTRAINT FK_F06D39707E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE Comment DROP CONSTRAINT FK_5BC96BF04B89032C');
        $this->addSql('ALTER TABLE Post DROP CONSTRAINT FK_FAB8C3B3FE54D947');
        $this->addSql('ALTER TABLE group_member DROP CONSTRAINT FK_A36222A8FE54D947');
        $this->addSql('ALTER TABLE invitation DROP CONSTRAINT FK_F11D61A2FE54D947');
        $this->addSql('ALTER TABLE Comment DROP CONSTRAINT FK_5BC96BF07E3C61F9');
        $this->addSql('ALTER TABLE Post DROP CONSTRAINT FK_FAB8C3B37E3C61F9');
        $this->addSql('ALTER TABLE group_member DROP CONSTRAINT FK_A36222A8A76ED395');
        $this->addSql('ALTER TABLE groups DROP CONSTRAINT FK_F06D39707E3C61F9');
        $this->addSql('DROP TABLE Comment');
        $this->addSql('DROP TABLE Post');
        $this->addSql('DROP TABLE group_member');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE invitation');
        $this->addSql('DROP TABLE users');
    }
}
