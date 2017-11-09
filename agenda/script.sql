--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.4
-- Dumped by pg_dump version 9.5.4

-- Started on 2017-11-06 23:35:14 BRST

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2115 (class 1262 OID 62881)
-- Name: agenda; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE agenda WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'pt_BR.UTF-8' LC_CTYPE = 'pt_BR.UTF-8';


ALTER DATABASE agenda OWNER TO postgres;

\connect agenda

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12360)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2118 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 184 (class 1259 OID 62892)
-- Name: contacts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE contacts (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    email character varying(255)
);


ALTER TABLE contacts OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 62890)
-- Name: contacts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE contacts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contacts_id_seq OWNER TO postgres;

--
-- TOC entry 2119 (class 0 OID 0)
-- Dependencies: 183
-- Name: contacts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE contacts_id_seq OWNED BY contacts.id;


--
-- TOC entry 182 (class 1259 OID 62884)
-- Name: phones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE phones (
    id integer NOT NULL,
    name character varying(50) NOT NULL,
    number character varying(20) NOT NULL,
    contact_id integer NOT NULL
);


ALTER TABLE phones OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 62882)
-- Name: phones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE phones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE phones_id_seq OWNER TO postgres;

--
-- TOC entry 2120 (class 0 OID 0)
-- Dependencies: 181
-- Name: phones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE phones_id_seq OWNED BY phones.id;


--
-- TOC entry 1991 (class 2604 OID 62895)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contacts ALTER COLUMN id SET DEFAULT nextval('contacts_id_seq'::regclass);


--
-- TOC entry 1990 (class 2604 OID 62887)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY phones ALTER COLUMN id SET DEFAULT nextval('phones_id_seq'::regclass);


--
-- TOC entry 1995 (class 2606 OID 62897)
-- Name: contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (id);


--
-- TOC entry 1993 (class 2606 OID 62889)
-- Name: phones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY phones
    ADD CONSTRAINT phones_pkey PRIMARY KEY (id);


--
-- TOC entry 1996 (class 2606 OID 62898)
-- Name: phones_contact_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY phones
    ADD CONSTRAINT phones_contact_id_fkey FOREIGN KEY (contact_id) REFERENCES contacts(id);


--
-- TOC entry 2117 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-11-06 23:35:14 BRST

--
-- PostgreSQL database dump complete
--

