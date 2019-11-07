
CREATE DATABASE dave_buisnessdb;
go

USE dave_buisnessdb;
go

-- Creating tables for database
Create TABLE contact 
(
    feedID			int		IDENTITY(1,1)		NOT NULL	PRIMARY KEY,
    fname			VARCHAR(60)			NOT NULL,
    lname			VARCHAR(60)			NOT NULL,
    email			VARCHAR(160)		NOT NULL,
    commBox 		TEXT				NOT NULL,
    
    INDEX email (email)
);

Create TABLE newsletter
(
    visitID			int			IDENTITY(1,1)		NOT NULL	PRIMARY KEY,
    fname			VARCHAR(60)			NOT NULL,
    lname			VARCHAR(60)			NOT NULL,
    email			VARCHAR(200)		NOT NULL,

    INDEX email (email)
);


--creating procedure for newsletter
USE [dave_buisnessdb]
GO



create procedure InsertNewsletter
@visitor_fname nchar(50),
@visitor_lname nchar(50),
@visitor_email nchar(50)
as
INSERT INTO [dbo].[newsletter]
           ([fname]
           ,[lname]
           ,[email])
     VALUES
           (@visitor_fname
           ,@visitor_lname
           ,@visitor_email)
GO

--creating user to access procedures
CREATE LOGIN [DVPApp] WITH PASSWORD='Pa$$w0rd', DEFAULT_DATABASE=[dave_buisnessdb]
go
use dave_buisnessdb
go
CREATE USER [DVPApp] FOR LOGIN [DVPApp] WITH DEFAULT_SCHEMA=[dbo]
GO

--granting permission to DVApp to allow use of newsletter procedure
grant execute on InsertNewsletter to DVPApp
go

-- creating contact procedure
create procedure InsertContact
@visitor_fname nchar(50),
@visitor_lname nchar(50),
@visitor_email nchar(50),
@visitor_comment nchar(200)
as
INSERT INTO [dbo].[contact]
           ([fname]
           ,[lname]
           ,[email]
           ,[commBox])
     VALUES
           (@visitor_fname
           ,@visitor_lname
           ,@visitor_email
           ,@visitor_comment)
GO

--granting permission to DVApp to use contact procedure
grant execute on InsertContact to DVPApp
go
