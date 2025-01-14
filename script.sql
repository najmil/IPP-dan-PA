USE [master]
GO
/****** Object:  Database [portal_ipp]    Script Date: 12/6/2023 9:54:08 PM ******/
CREATE DATABASE [portal_ipp]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'portal_ipp', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS\MSSQL\DATA\portal_ipp.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'portal_ipp_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.SQLEXPRESS\MSSQL\DATA\portal_ipp_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [portal_ipp] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [portal_ipp].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [portal_ipp] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [portal_ipp] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [portal_ipp] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [portal_ipp] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [portal_ipp] SET ARITHABORT OFF 
GO
ALTER DATABASE [portal_ipp] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [portal_ipp] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [portal_ipp] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [portal_ipp] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [portal_ipp] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [portal_ipp] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [portal_ipp] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [portal_ipp] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [portal_ipp] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [portal_ipp] SET  DISABLE_BROKER 
GO
ALTER DATABASE [portal_ipp] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [portal_ipp] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [portal_ipp] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [portal_ipp] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [portal_ipp] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [portal_ipp] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [portal_ipp] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [portal_ipp] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [portal_ipp] SET  MULTI_USER 
GO
ALTER DATABASE [portal_ipp] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [portal_ipp] SET DB_CHAINING OFF 
GO
ALTER DATABASE [portal_ipp] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [portal_ipp] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [portal_ipp] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [portal_ipp] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [portal_ipp] SET QUERY_STORE = OFF
GO
USE [portal_ipp]
GO
/****** Object:  Table [dbo].[ipp_lampau]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ipp_lampau](
	[id] [int] NOT NULL,
	[id_department] [int] NULL,
	[periode] [varchar](255) NULL,
	[created_by] [int] NULL,
	[file_data] [varbinary](max) NULL,
	[created_at] [datetime] NULL,
	[kode_jabatan] [int] NULL,
	[id_division] [int] NULL,
	[id_section] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[isi_ipp]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[isi_ipp](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[is_submitted_ipp_one] [tinyint] NULL,
	[is_submitted_ipp_mid] [tinyint] NULL,
	[program] [varchar](255) NULL,
	[weight] [float] NULL,
	[midyear] [text] NULL,
	[midyear_achv] [text] NULL,
	[midyear_achv_score] [float] NULL,
	[midyear_achv_total] [float] NULL,
	[oneyear] [text] NULL,
	[oneyear_achv] [text] NULL,
	[oneyear_achv_score] [float] NULL,
	[oneyear_achv_total] [float] NULL,
	[duedate] [date] NULL,
	[status] [varchar](255) NULL,
	[is_submitted] [tinyint] NULL,
	[is_submitted_one] [tinyint] NULL,
	[is_submitted_ipp] [tinyint] NULL,
	[id_main] [int] NULL,
	[id_division] [int] NULL,
	[id_department] [int] NULL,
	[id_section] [int] NULL,
	[is_sumitted_ipp] [tinyint] NULL,
	[is_sumitted_ipp_mid] [tinyint] NULL,
	[is_sumitted_ipp_one] [tinyint] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[isi_ipp_log]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[isi_ipp_log](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[action] [varchar](255) NULL,
	[table_name] [varchar](255) NULL,
	[record_id] [int] NULL,
	[data_changes] [nvarchar](max) NULL,
	[created_at] [datetime] NULL,
	[by] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[main]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[main](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_department] [int] NULL,
	[department] [varchar](255) NULL,
	[id_division] [int] NULL,
	[division] [varchar](255) NULL,
	[id_section] [int] NULL,
	[section] [varchar](255) NULL,
	[date_submitted_ipp_mid] [date] NULL,
	[date_submitted_ipp_one] [date] NULL,
	[is_submitted_ipp_one] [tinyint] NULL,
	[is_submitted_ipp_mid] [tinyint] NULL,
	[date_submitted] [date] NULL,
	[date_submitted_ipp] [date] NULL,
	[date_submitted_one] [date] NULL,
	[is_approved_presdir] [tinyint] NULL,
	[is_approved_bod] [tinyint] NULL,
	[is_approved_kadiv] [tinyint] NULL,
	[is_approved_kadept] [tinyint] NULL,
	[is_approved_kasie] [tinyint] NULL,
	[is_approved_presdir_mid] [tinyint] NULL,
	[is_approved_bod_mid] [tinyint] NULL,
	[is_approved_kadiv_mid] [tinyint] NULL,
	[is_approved_kadept_mid] [tinyint] NULL,
	[is_approved_kasie_mid] [tinyint] NULL,
	[is_approved_presdir_one] [tinyint] NULL,
	[is_approved_bod_one] [tinyint] NULL,
	[is_approved_kadiv_one] [tinyint] NULL,
	[is_approved_kadept_one] [tinyint] NULL,
	[is_approved_kasie_one] [tinyint] NULL,
	[nama] [varchar](255) NOT NULL,
	[created_by] [int] NULL,
	[kode_jabatan] [int] NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NOT NULL,
	[approval_bod] [tinyint] NULL,
	[approval_presdir] [tinyint] NULL,
	[approval_kadept] [tinyint] NULL,
	[approval_kadiv] [tinyint] NULL,
	[approval_kasie] [tinyint] NULL,
	[approval_date_presdir] [date] NULL,
	[approval_date_bod] [date] NULL,
	[approval_date_kadiv] [date] NULL,
	[approval_date_kadept] [date] NULL,
	[approval_date_kasie] [date] NULL,
	[approval_kadept_midyear] [tinyint] NULL,
	[approval_kadiv_midyear] [tinyint] NULL,
	[approval_kasie_midyear] [tinyint] NULL,
	[approval_date_presdir_midyear] [date] NULL,
	[approval_date_bod_midyear] [date] NULL,
	[approval_date_kadiv_midyear] [date] NULL,
	[approval_date_kadept_midyear] [date] NULL,
	[approval_date_kasie_midyear] [date] NULL,
	[approval_kadept_oneyear] [tinyint] NULL,
	[approval_kadiv_oneyear] [tinyint] NULL,
	[approval_kasie_oneyear] [tinyint] NULL,
	[approval_date_presdir_oneyear] [date] NULL,
	[approval_date_bod_oneyear] [date] NULL,
	[approval_date_kadiv_oneyear] [date] NULL,
	[approval_date_kadept_oneyear] [date] NULL,
	[approval_date_kasie_oneyear] [date] NULL,
	[approved_presdir_by] [varchar](255) NULL,
	[approved_bod_by] [varchar](255) NULL,
	[approved_kadiv_by] [varchar](255) NULL,
	[approved_kadept_by] [varchar](255) NULL,
	[approved_kasie_by] [varchar](255) NULL,
	[approved_presdir_by_mid] [varchar](255) NULL,
	[approved_bod_by_mid] [varchar](255) NULL,
	[approved_kadiv_by_mid] [varchar](255) NULL,
	[approved_kadept_by_mid] [varchar](255) NULL,
	[approved_kasie_by_mid] [varchar](255) NULL,
	[approved_presdir_by_one] [varchar](255) NULL,
	[approved_bod_by_one] [varchar](255) NULL,
	[approved_kadiv_by_one] [varchar](255) NULL,
	[approved_kadept_by_one] [varchar](255) NULL,
	[approved_kasie_by_one] [varchar](255) NULL,
	[is_submitted] [tinyint] NULL,
	[is_submitted_ipp] [tinyint] NULL,
	[is_submitted_one] [tinyint] NULL,
	[periode] [varchar](255) NULL,
	[approval_presdir_oneyear] [tinyint] NULL,
	[approval_bod_oneyear] [tinyint] NULL,
	[approval_presdir_midyear] [tinyint] NULL,
	[approval_bod_midyear] [tinyint] NULL,
	[sum_midyear_total] [float] NULL,
	[files] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[midyear]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[midyear](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_main] [int] NULL,
	[is_submitted] [tinyint] NULL,
	[program] [text] NULL,
	[weight] [float] NULL,
	[midyear] [text] NULL,
	[midyear_achv] [text] NULL,
	[midyear_achv_score] [float] NULL,
	[midyear_achv_total] [float] NULL,
	[sum_total] [float] NULL,
	[duedate] [date] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[oneyear]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[oneyear](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_main] [int] NULL,
	[is_submitted] [tinyint] NULL,
	[program] [text] NULL,
	[oneyear] [text] NULL,
	[oneyear_achv] [text] NULL,
	[oneyear_achv_score] [float] NULL,
	[oneyear_achv_total] [float] NULL,
	[duedate] [date] NULL,
	[weight] [float] NULL,
	[sum_total] [float] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[periode]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[periode](
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
	[name] [varchar](255) NULL,
	[start_period] [datetime] NULL,
	[end_period] [datetime] NULL,
	[id] [int] IDENTITY(1,1) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[proc_sum]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[proc_sum](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_isi_ipp_main] [int] NULL,
	[is_saved_oneyear] [tinyint] NULL,
	[midyear_achv_total] [float] NULL,
	[plan_mid] [float] NULL,
	[do_mid] [float] NULL,
	[check_mid] [float] NULL,
	[act_mid] [float] NULL,
	[teamwork_mid] [float] NULL,
	[cust_mid] [float] NULL,
	[passion_mid] [float] NULL,
	[gc_mid] [float] NULL,
	[delegating_mid] [float] NULL,
	[couch_mid] [float] NULL,
	[develop_mid] [float] NULL,
	[b1_average] [float] NULL,
	[b2_average] [float] NULL,
	[pdca_mid] [float] NULL,
	[pm_mid] [float] NULL,
	[result_mid] [float] NULL,
	[midyear_value] [float] NULL,
	[oneyear_achv_total] [float] NULL,
	[plan_one] [float] NULL,
	[do_one] [float] NULL,
	[check_one] [float] NULL,
	[act_one] [float] NULL,
	[teamwork_one] [float] NULL,
	[cust_one] [float] NULL,
	[passion_one] [float] NULL,
	[gc_one] [float] NULL,
	[delegating_one] [float] NULL,
	[couch_one] [float] NULL,
	[develop_one] [float] NULL,
	[b1_average_one] [float] NULL,
	[b2_average_one] [float] NULL,
	[pdca_one] [float] NULL,
	[pm_one] [float] NULL,
	[result_one] [float] NULL,
	[oneyear_value] [float] NULL,
	[is_submitted_oneyear] [tinyint] NULL,
	[is_submitted_midyear] [tinyint] NULL,
	[id_procsum_main] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[procsum_main]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[procsum_main](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[is_submitted_midyear] [tinyint] NULL,
	[date_submitted] [date] NULL,
	[is_approved_presdir] [tinyint] NULL,
	[is_approved_bod] [tinyint] NULL,
	[is_approved_kadiv] [tinyint] NULL,
	[is_approved_kadept] [tinyint] NULL,
	[is_approved_kasie] [tinyint] NULL,
	[id_department] [int] NULL,
	[department] [varchar](255) NULL,
	[id_division] [int] NULL,
	[division] [varchar](255) NULL,
	[id_section] [int] NULL,
	[section] [varchar](255) NULL,
	[periode] [varchar](255) NULL,
	[created_by] [int] NULL,
	[kode_jabatan] [int] NULL,
	[nama] [varchar](255) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
	[files] [varchar](255) NULL,
	[approved_presdir_by] [varchar](255) NULL,
	[approved_bod_by] [varchar](255) NULL,
	[approved_kadiv_by] [varchar](255) NULL,
	[approved_kadept_by] [varchar](255) NULL,
	[approved_kasie_by] [varchar](255) NULL,
	[is_submitted_oneyear] [tinyint] NULL,
	[date_submitted_oneyear] [date] NULL,
	[is_approved_presdir_oneyear] [tinyint] NULL,
	[is_approved_bod_oneyear] [tinyint] NULL,
	[is_approved_kadiv_oneyear] [tinyint] NULL,
	[is_approved_kadept_oneyear] [tinyint] NULL,
	[is_approved_kasie_oneyear] [tinyint] NULL,
	[approval_kadept_midyear] [tinyint] NULL,
	[approval_kadiv_midyear] [tinyint] NULL,
	[approval_kasie_midyear] [tinyint] NULL,
	[approval_bod_midyear] [tinyint] NULL,
	[approval_presdir_midyear] [tinyint] NULL,
	[approval_date_presdir_midyear] [date] NULL,
	[approval_date_bod_midyear] [date] NULL,
	[approval_date_kadiv_midyear] [date] NULL,
	[approval_date_kadept_midyear] [date] NULL,
	[approval_date_kasie_midyear] [date] NULL,
	[approval_kadept_oneyear] [tinyint] NULL,
	[approval_kadiv_oneyear] [tinyint] NULL,
	[approval_kasie_oneyear] [tinyint] NULL,
	[approval_bod_oneyear] [tinyint] NULL,
	[approval_presdir_oneyear] [tinyint] NULL,
	[approval_date_presdir_oneyear] [date] NULL,
	[approval_date_bod_oneyear] [date] NULL,
	[approval_date_kadiv_oneyear] [date] NULL,
	[approval_date_kadept_oneyear] [date] NULL,
	[approval_date_kasie_oneyear] [date] NULL,
	[presdir_by_oneyear] [varchar](255) NULL,
	[bod_by_oneyear] [varchar](255) NULL,
	[kadiv_by_oneyear] [varchar](255) NULL,
	[kadept_by_oneyear] [varchar](255) NULL,
	[kasie_by_oneyear] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[strongweak]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[strongweak](
	[is_submitted] [tinyint] NULL,
	[strong_mid] [text] NULL,
	[weak_mid] [text] NULL,
	[strong_one] [text] NULL,
	[weak_one] [text] NULL,
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_strongweak_main] [int] NULL,
	[note_mid] [text] NULL,
	[note_one] [text] NULL,
	[is_submitted_one] [tinyint] NULL,
	[alc_mid] [varchar](255) NULL,
	[sub_alc_mid] [varchar](255) NULL,
	[technical_mid] [varchar](255) NULL,
	[strong_mid_alc] [varchar](255) NULL,
	[technical_value_mid] [varchar](255) NULL,
	[weak_alc_mid] [varchar](255) NULL,
	[weak_sub_alc_mid] [varchar](255) NULL,
	[weak_technical_mid] [varchar](255) NULL,
	[weak_mid_alc] [varchar](255) NULL,
	[weak_technical_value_mid] [varchar](255) NULL,
	[is_saved_midyear] [tinyint] NULL,
	[alc_one] [varchar](255) NULL,
	[sub_alc_one] [varchar](255) NULL,
	[technical_one] [varchar](255) NULL,
	[strong_one_alc] [varchar](255) NULL,
	[technical_value_one] [varchar](255) NULL,
	[weak_alc_one] [varchar](255) NULL,
	[weak_sub_alc_one] [varchar](255) NULL,
	[weak_technical_one] [varchar](255) NULL,
	[weak_one_alc] [varchar](255) NULL,
	[weak_technical_value_one] [varchar](255) NULL,
	[is_saved_oneyear] [tinyint] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[strongweak_main]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[strongweak_main](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[is_submitted] [tinyint] NULL,
	[date_submitted] [date] NULL,
	[is_submitted_one] [tinyint] NULL,
	[date_submitted_one] [date] NULL,
	[nama] [varchar](255) NULL,
	[id_department] [int] NULL,
	[department] [varchar](255) NULL,
	[id_division] [int] NULL,
	[division] [varchar](255) NULL,
	[id_section] [int] NULL,
	[section] [varchar](255) NULL,
	[periode] [varchar](255) NULL,
	[created_by] [int] NULL,
	[kode_jabatan] [int] NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
	[files] [varchar](255) NULL,
	[approval_kadept_strongweak] [int] NULL,
	[approval_kadiv_strongweak] [int] NULL,
	[approval_kasie_strongweak] [int] NULL,
	[approval_bod_strongweak] [tinyint] NULL,
	[approval_presdir_strongweak] [tinyint] NULL,
	[approval_date_presdir_strongweak] [date] NULL,
	[approval_date_bod_strongweak] [date] NULL,
	[approval_date_kadiv_strongweak] [date] NULL,
	[approval_date_kadept_strongweak] [date] NULL,
	[approval_date_kasie_strongweak] [date] NULL,
	[is_approved] [tinyint] NULL,
	[is_approved_presdir] [tinyint] NULL,
	[is_approved_bod] [tinyint] NULL,
	[is_approved_kadiv] [tinyint] NULL,
	[is_approved_kadept] [tinyint] NULL,
	[is_approved_kasie] [tinyint] NULL,
	[is_approved_oneyear] [tinyint] NULL,
	[is_approved_presdir_oneyear] [tinyint] NULL,
	[is_approved_bod_oneyear] [tinyint] NULL,
	[is_approved_kadiv_oneyear] [tinyint] NULL,
	[is_approved_kadept_oneyear] [tinyint] NULL,
	[is_approved_kasie_oneyear] [tinyint] NULL,
	[approval_kadept_oneyear] [int] NULL,
	[approval_kadiv_oneyear] [int] NULL,
	[approval_kasie_oneyear] [int] NULL,
	[approval_bod_oneyear] [tinyint] NULL,
	[approval_presdir_oneyear] [tinyint] NULL,
	[approval_date_presdir_oneyear] [date] NULL,
	[approval_date_bod_oneyear] [date] NULL,
	[approval_date_kadiv_oneyear] [date] NULL,
	[approval_date_kadept_oneyear] [date] NULL,
	[approval_date_kasie_oneyear] [date] NULL,
	[approved_presdir_by] [varchar](255) NULL,
	[approved_bod_by] [varchar](255) NULL,
	[approved_kadiv_by] [varchar](255) NULL,
	[approved_kadept_by] [varchar](255) NULL,
	[approved_kasie_by] [varchar](255) NULL,
	[presdir_by_oneyear] [varchar](255) NULL,
	[bod_by_oneyear] [varchar](255) NULL,
	[kadiv_by_oneyear] [varchar](255) NULL,
	[kadept_by_oneyear] [varchar](255) NULL,
	[kasie_by_oneyear] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 12/6/2023 9:54:09 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[npk] [int] NOT NULL,
	[nama] [varchar](255) NOT NULL,
	[username] [varchar](255) NOT NULL,
	[kode_jabatan] [int] NOT NULL,
	[id_division] [int] NULL,
	[division] [varchar](255) NULL,
	[id_department] [int] NULL,
	[department] [varchar](255) NULL,
	[id_section] [int] NULL,
	[section] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
USE [master]
GO
ALTER DATABASE [portal_ipp] SET  READ_WRITE 
GO
