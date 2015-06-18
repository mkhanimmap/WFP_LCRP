--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Name: wfp_admin_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_admin_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_admin_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: wfp_admin; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_admin (
    id integer DEFAULT nextval('wfp_admin_id_seq'::regclass) NOT NULL,
    username character varying(255),
    password character varying(255),
    email character varying(255),
    status integer
);


ALTER TABLE public.wfp_admin OWNER TO postgres;

--
-- Name: wfp_country; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_country (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    status integer NOT NULL,
    map_center text,
    zoom integer
);


ALTER TABLE public.wfp_country OWNER TO postgres;

--
-- Name: wfp_country_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_country_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_country_id_seq OWNER TO postgres;

--
-- Name: wfp_country_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_country_id_seq OWNED BY wfp_country.id;


--
-- Name: wfp_group; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_group (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    status integer
);


ALTER TABLE public.wfp_group OWNER TO postgres;

--
-- Name: wfp_group_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_group_id_seq OWNER TO postgres;

--
-- Name: wfp_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_group_id_seq OWNED BY wfp_group.id;


--
-- Name: wfp_layers; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_layers (
    id integer NOT NULL,
    layer_level_id integer NOT NULL,
    parent_id integer,
    title text,
    cartodb_index character varying(255) NOT NULL,
    status integer NOT NULL,
    visualization_type_id integer,
    group_id integer,
    country_id integer,
    layer_type integer,
    indicator text
);


ALTER TABLE public.wfp_layers OWNER TO postgres;

--
-- Name: wfp_layers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_layers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_layers_id_seq OWNER TO postgres;

--
-- Name: wfp_layers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_layers_id_seq OWNED BY wfp_layers.id;


--
-- Name: wfp_layers_level; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_layers_level (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    status integer NOT NULL
);


ALTER TABLE public.wfp_layers_level OWNER TO postgres;

--
-- Name: wfp_layers_level_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_layers_level_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_layers_level_id_seq OWNER TO postgres;

--
-- Name: wfp_layers_level_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_layers_level_id_seq OWNED BY wfp_layers_level.id;


--
-- Name: wfp_org; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_org (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    status integer NOT NULL
);


ALTER TABLE public.wfp_org OWNER TO postgres;

--
-- Name: wfp_org_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_org_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_org_id_seq OWNER TO postgres;

--
-- Name: wfp_org_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_org_id_seq OWNED BY wfp_org.id;


--
-- Name: wfp_user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_user (
    id integer NOT NULL,
    org_id integer NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    status integer NOT NULL,
    name character varying(255),
    allow_download integer
);


ALTER TABLE public.wfp_user OWNER TO postgres;

--
-- Name: wfp_user_country; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_user_country (
    id integer NOT NULL,
    user_id integer NOT NULL,
    country_id integer NOT NULL
);


ALTER TABLE public.wfp_user_country OWNER TO postgres;

--
-- Name: wfp_user_country_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_user_country_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_user_country_id_seq OWNER TO postgres;

--
-- Name: wfp_user_country_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_user_country_id_seq OWNED BY wfp_user_country.id;


--
-- Name: wfp_user_group; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_user_group (
    id integer NOT NULL,
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE public.wfp_user_group OWNER TO postgres;

--
-- Name: wfp_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_user_group_id_seq OWNER TO postgres;

--
-- Name: wfp_user_group_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_user_group_id_seq OWNED BY wfp_user_group.id;


--
-- Name: wfp_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_user_id_seq OWNER TO postgres;

--
-- Name: wfp_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_user_id_seq OWNED BY wfp_user.id;


--
-- Name: wfp_visualization_type; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE wfp_visualization_type (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    country_id integer NOT NULL,
    status integer NOT NULL,
    visualization_url text,
    default_select integer
);


ALTER TABLE public.wfp_visualization_type OWNER TO postgres;

--
-- Name: wfp_visualization_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE wfp_visualization_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.wfp_visualization_type_id_seq OWNER TO postgres;

--
-- Name: wfp_visualization_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE wfp_visualization_type_id_seq OWNED BY wfp_visualization_type.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_country ALTER COLUMN id SET DEFAULT nextval('wfp_country_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_group ALTER COLUMN id SET DEFAULT nextval('wfp_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_layers ALTER COLUMN id SET DEFAULT nextval('wfp_layers_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_layers_level ALTER COLUMN id SET DEFAULT nextval('wfp_layers_level_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_org ALTER COLUMN id SET DEFAULT nextval('wfp_org_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_user ALTER COLUMN id SET DEFAULT nextval('wfp_user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_user_country ALTER COLUMN id SET DEFAULT nextval('wfp_user_country_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_user_group ALTER COLUMN id SET DEFAULT nextval('wfp_user_group_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY wfp_visualization_type ALTER COLUMN id SET DEFAULT nextval('wfp_visualization_type_id_seq'::regclass);


--
-- Data for Name: wfp_admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_admin VALUES (1, 'admin', 'admin', 'wfpadmin@wfp.org', 1);


--
-- Name: wfp_admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_admin_id_seq', 1, true);


--
-- Data for Name: wfp_country; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_country VALUES (1, 'Lebanon', 1, '33.906896, 35.771484', 9);
INSERT INTO wfp_country VALUES (2, 'Syria', 1, '35.448349, 38.376286', 8);
INSERT INTO wfp_country VALUES (3, 'Jordan', 1, '31.237600, 36.371689', 7);


--
-- Name: wfp_country_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_country_id_seq', 3, true);


--
-- Data for Name: wfp_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_group VALUES (1, 'Public', 1);
INSERT INTO wfp_group VALUES (2, 'Private', 1);


--
-- Name: wfp_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_group_id_seq', 2, true);


--
-- Data for Name: wfp_layers; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_layers VALUES (12, 1, 0, 'Outcome 2 Promote food availability and sustainable production', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (13, 1, 0, 'Outcome 3 Promote utilization of diversified and quality food', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (54, 4, 26, 'No. of people adopting by-product transformation technologies', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (37, 4, 34, 'No. of people receiving training on nutritional practices (male)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (40, 4, 35, 'No. of government staff trained (male)', '1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (41, 4, 33, 'No. of farmers trained on good agricultural practices and standards', '0', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (14, 1, 0, 'Outcome 4 Enhance effective and coordinated food security response', '-1', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (5, 3, 2, 'By Beneficiary Group', '-1', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (61, 4, 60, 'No. of animals vaccinated/treated', '4', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (55, 4, 27, 'No. of people receiving training on food reservation technologies ', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (1, 1, 0, 'Outcome 1: Stabilization of food consumption', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (56, 4, 27, 'No. of facilities constructed/equipped for food preservation', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (3, 3, 2, 'By Modality', '-1', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (36, 4, 34, 'No. of people receiving training on nutritional practices (female)', '4', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (11, 4, 5, 'Palestinian Refugees from Lebanon (PRL)', '3', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (10, 4, 5, 'Vulnerable Lebanese', '2', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (9, 4, 5, 'Syrian Refugees', '1', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (8, 4, 5, 'Palestinian Refugees from Lebanon (PRS)', '0', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (7, 4, 3, 'Cash Assistance (ATM card)', '5', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (6, 3, 2, 'Number of people receiving one-off food parcels (WFP)', '-1', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (4, 4, 3, 'Number of people receiving e-cards', '4', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (15, 3, 2, 'Number of people receiving vouchers', '-1', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (16, 2, 1, 'Food Assistance Provided ', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (17, 3, 16, 'Number of people receiving one-off food parcels (others)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (18, 3, 16, 'Number of people receiving one-off food parcels (WFP)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (19, 3, 16, 'Number of people receiving food for trainings', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (25, 2, 12, 'Food waste and losses reduced (through post-harvest management)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (24, 2, 12, 'Small-scale/family farming production activities supported', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (28, 2, 12, 'Improved agriculture production through climate smart farming technologies', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (29, 2, 12, 'Control of trans-border animal and plant diseases supported ', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (32, 2, 13, ' Food safety measures and policies enhanced', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (31, 3, 30, 'Improved food diversity ', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (34, 3, 30, 'Nutrition behaviors and practices promoted', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (33, 3, 32, 'Integrated pest management and good agricultural practices promoted', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (35, 3, 32, 'Government assisted in improving food inspection', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (2, 2, 1, 'Food Assistance provided ', '-1', 0, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (30, 2, 13, 'Increased awareness of nutritional practices', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (57, 3, 28, 'Promotion of water conservation and efficient irrigation practices', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (58, 4, 57, 'No. of people receiving training on new water conservation technologies (female)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (39, 4, 35, 'No. of government staff trained (female)', '2', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (59, 4, 57, 'No. of people receiving training on new water conservation technologies (male)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (42, 3, 24, 'No. of people receiving training and inputs (livestock) (female)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (43, 3, 24, 'No. of people receiving training and inputs (livestock) (male)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (44, 3, 24, 'No. of people receiving training and inputs (fruits & vegs) (female)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (45, 3, 24, 'No. of people receiving training and inputs (fruits & vegs) (male)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (46, 3, 24, 'No. of cooperatives created/supported', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (27, 3, 25, 'Promotion of food preservation technologies', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (47, 3, 25, 'Improved post-harvest management', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (48, 4, 47, 'No. of people receiving training on post-harvest management (female)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (49, 4, 47, 'No. of people receiving training on post-harvest management (male)', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (50, 4, 47, 'No. of farmers provided with improved technology  (female) ', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (51, 4, 47, 'No. of farmers provided with improved technology  (male) ', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (52, 3, 24, 'No. of households benefiting from cooperatives', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (60, 3, 29, 'Emergency interventions to control spread of trans-border diseases supported ', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (62, 4, 60, 'No. of Ha treated', '0', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (63, 1, 0, 'Outcome 1 Stabilization of food consumption', '-1', 1, 2, 1, 1, -1, NULL);
INSERT INTO wfp_layers VALUES (38, 4, 31, 'No. of people benefiting from vegetable gardens', '-1', 1, 1, 1, 1, NULL, NULL);
INSERT INTO wfp_layers VALUES (64, 2, 63, 'Food Assistance Provided', '-1', 1, 2, 1, 1, -1, NULL);
INSERT INTO wfp_layers VALUES (69, 1, 0, 'Layers', '-1', 1, 6, 1, 1, -1, NULL);
INSERT INTO wfp_layers VALUES (20, 3, 16, 'Number of people receiving cash for food through ATMs ', '-1', 1, 1, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (71, 2, 69, 'Money Injected', '4', 1, 6, 1, 1, 1, NULL);
INSERT INTO wfp_layers VALUES (70, 2, 69, 'Shops', '5', 0, 6, 1, 1, 2, NULL);
INSERT INTO wfp_layers VALUES (23, 3, 16, 'Number of people receiving e-cards ', '-1', 1, 1, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (68, 3, 64, 'Number of people receiving cash for food through ATMs ', '3', 1, 2, 1, 1, 1, '''PRS - # of vulnerable individuals receiving cash for food through ATM cards (UNRWA)''');
INSERT INTO wfp_layers VALUES (53, 4, 26, 'No. of people receiving training on volarisation processes ', '-1', 1, 1, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (22, 3, 16, 'Number of people receiving food vouchers ', '-1', 1, 1, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (21, 3, 16, 'Number of people receiving food parcels ', '-1', 0, 1, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (26, 3, 25, 'Volarisation of leftovers after discussions', '-1', 1, 1, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (96, 2, 88, 'Food waste and losses reduced (through post-harvest management)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (126, 3, 123, 'Government assisted in improving food inspection', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (108, 2, 88, 'Improved agriculture production through climate smart farming technologies', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (72, 3, 64, 'Amount of cash (USD) redeemed through e-cards', '0', 0, 2, 1, 1, 1, '''Amount of cash (USD) redeemed through e-cards''');
INSERT INTO wfp_layers VALUES (109, 3, 108, 'Promotion of water conservation and efficient irrigation practices', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (65, 3, 64, 'Number of people receiving food vouchers ', '0', 1, 2, 1, 1, 1, '''AffLeb-# of vulnerable individuals receiving food vouchers'',''DisSyr - # of vulnerable individuals receiving food vouchers'',''PRL - # of vulnerable individuals receiving food vouchers'',''PRS - # of vulnerable individuals receiving food vouchers''');
INSERT INTO wfp_layers VALUES (73, 1, 0, 'Jordan Layers', '-1', 1, 5, 1, 3, -1, '');
INSERT INTO wfp_layers VALUES (76, 2, 73, 'Refugees', '3', 1, 5, 1, 3, 1, '');
INSERT INTO wfp_layers VALUES (77, 2, 73, 'Beneficiaries By Governorate', '1', 1, 5, 1, 3, 1, '');
INSERT INTO wfp_layers VALUES (78, 2, 73, 'Beneficiaries By District', '2', 1, 5, 1, 3, 1, '');
INSERT INTO wfp_layers VALUES (79, 2, 73, 'Beneficiaries By Voucher value', '1', 1, 5, 1, 3, 1, '');
INSERT INTO wfp_layers VALUES (80, 2, 73, 'Partners', '0', 1, 5, 1, 3, 1, '');
INSERT INTO wfp_layers VALUES (81, 2, 69, 'Refugees', '0', 1, 6, 1, 1, 1, '');
INSERT INTO wfp_layers VALUES (82, 2, 69, 'E-Card Beneficiaries', '2', 1, 6, 1, 1, 1, '');
INSERT INTO wfp_layers VALUES (83, 2, 69, 'Food Parcel Beneficiaries', '3', 1, 6, 1, 1, 1, '');
INSERT INTO wfp_layers VALUES (84, 2, 69, 'Partners (Vouchers)', '8', 1, 6, 1, 1, 1, '');
INSERT INTO wfp_layers VALUES (85, 2, 69, 'Partners (Parcels)', '7', 1, 6, 1, 1, 1, '');
INSERT INTO wfp_layers VALUES (86, 2, 69, 'Shops', '5', 1, 6, 1, 1, 2, '');
INSERT INTO wfp_layers VALUES (110, 4, 109, 'No. of people receiving training on new water conservation technologies (female)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (87, 2, 69, 'Distribution Sites', '6', 1, 6, 1, 1, 2, '');
INSERT INTO wfp_layers VALUES (88, 1, 0, 'Outcome 2 Promote food availability and sustainable production', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (89, 2, 88, 'Small-scale/family farming production activities supported', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (92, 3, 89, 'No. of people receiving training and inputs (fruits & vegs) (female)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (93, 3, 89, 'No. of people receiving training and inputs (fruits & vegs) (male)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (94, 3, 89, 'No. of cooperatives created/supported', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (95, 3, 89, 'No. of households benefiting from cooperatives', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (99, 4, 97, 'No. of people adopting by-product transformation technologies', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (100, 3, 96, 'Promotion of food preservation technologies', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (101, 4, 100, 'No. of people receiving training on food reservation technologies', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (102, 4, 100, 'No. of facilities constructed/equipped for food preservation', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (103, 3, 96, 'Improved post-harvest management', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (104, 4, 103, 'No. of people receiving training on post-harvest management (female)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (105, 4, 103, 'No. of people receiving training on post-harvest management (male)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (106, 4, 103, 'No. of farmers provided with improved technology  (female)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (107, 4, 103, 'No. of farmers provided with improved technology  (male)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (127, 4, 126, 'No. of government staff trained (female)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (111, 4, 109, 'No. of people receiving training on new water conservation technologies (male)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (112, 2, 88, 'Control of trans-border animal and plant diseases supported', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (113, 3, 112, 'Emergency interventions to control spread of trans-border diseases supported', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (114, 4, 113, 'No. of animals vaccinated/treated', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (115, 4, 113, 'No. of Ha treated', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (116, 1, 0, 'Outcome 3 Promote utilization of diversified and quality food', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (117, 2, 116, 'Increased awareness of nutritional practices', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (118, 3, 117, 'Improved food diversity', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (119, 4, 118, 'No. of people benefiting from vegetable gardens', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (120, 3, 117, 'Nutrition behaviors and practices promoted', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (121, 4, 120, 'No. of people receiving training on nutritional practices (female)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (122, 4, 120, 'No. of people receiving training on nutritional practices (male)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (123, 2, 116, ' Food safety measures and policies enhanced', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (124, 3, 123, 'Integrated pest management and good agricultural practices promoted', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (125, 4, 124, 'No. of farmers trained on good agricultural practices and standards', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (128, 4, 126, 'No. of government staff trained (male)', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (67, 3, 64, 'Number of people receiving one-off food parcels (WFP) ', '2', 1, 2, 1, 1, 1, '''DisSyr - # of individuals receiving food parcels (WFP)''');
INSERT INTO wfp_layers VALUES (131, 3, 64, 'Number of food parcels distributed (??? GFD or one-off & No. of ppl)', '2', 1, 2, 1, 1, 1, '''AffLeb - # of other food parcels distributed'',''DisSyr - # of other food parcels distributed''');
INSERT INTO wfp_layers VALUES (130, 3, 64, 'Number of people receiving one-off food parcels (others)', '2', 1, 2, 1, 1, 1, '''DisSyr - # of individuals receiving food parcels'',''Others - # of individuals receiving food parcels''');
INSERT INTO wfp_layers VALUES (90, 3, 89, 'No. of people receiving training and inputs (livestock) (female)', '2', 1, 2, 1, 1, -1, '''Female - # of dairy farmers supported with technical training & handling materials/equipment (includes all livestock)''');
INSERT INTO wfp_layers VALUES (91, 3, 89, 'No. of people receiving training and inputs (livestock) (male)', '2', 1, 2, 1, 1, -1, '''Male - # of dairy farmers supported with technical training & handling materials/equipment (includes all livestock)''');
INSERT INTO wfp_layers VALUES (98, 4, 97, 'No. of people receiving training on volarisation processes', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (97, 3, 96, 'Volarisation of leftovers after discussions', '-1', 1, 2, 1, 1, -1, '');
INSERT INTO wfp_layers VALUES (74, 2, 73, 'Camps', '5', 1, 5, 1, 3, 1, '');
INSERT INTO wfp_layers VALUES (75, 2, 73, 'Shops', '6', 1, 5, 1, 3, 2, '');
INSERT INTO wfp_layers VALUES (66, 3, 64, 'Number of people receiving e-cards', '1', 1, 2, 1, 1, 1, '''DisSyr - # of vulnerable individuals receiving e-cards''');


--
-- Name: wfp_layers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_layers_id_seq', 131, true);


--
-- Data for Name: wfp_layers_level; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_layers_level VALUES (1, 'level1', 1);
INSERT INTO wfp_layers_level VALUES (2, 'level2', 1);
INSERT INTO wfp_layers_level VALUES (3, 'level3', 1);
INSERT INTO wfp_layers_level VALUES (4, 'level4', 1);


--
-- Name: wfp_layers_level_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_layers_level_id_seq', 4, true);


--
-- Data for Name: wfp_org; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_org VALUES (1, 'WFP', 1);
INSERT INTO wfp_org VALUES (2, 'iMMAP', 1);


--
-- Name: wfp_org_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_org_id_seq', 2, true);


--
-- Data for Name: wfp_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_user VALUES (1, 2, 'Public', '111111', 'public@wfp.org', 1, 'Public', 0);
INSERT INTO wfp_user VALUES (2, 2, 'mkhan', '111111', 'mkhan@immap.org', 1, 'Mehtab Khan', 1);
INSERT INTO wfp_user VALUES (3, 1, 'test', 'test', 'test@test.com', 1, 'test', 1);


--
-- Data for Name: wfp_user_country; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: wfp_user_country_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_user_country_id_seq', 3, true);


--
-- Data for Name: wfp_user_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_user_group VALUES (1, 1, 2);
INSERT INTO wfp_user_group VALUES (2, 3, 2);
INSERT INTO wfp_user_group VALUES (3, 3, 1);
INSERT INTO wfp_user_group VALUES (4, 2, 1);
INSERT INTO wfp_user_group VALUES (7, 2, 2);


--
-- Name: wfp_user_group_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_user_group_id_seq', 7, true);


--
-- Name: wfp_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_user_id_seq', 3, true);


--
-- Data for Name: wfp_visualization_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO wfp_visualization_type VALUES (1, 'Plan', 1, 1, 'http://syriainfo.cartodb.doylesolutions.ie/api/v2/viz/7b56c4f6-9fce-11e4-8004-005056821820/viz.json', 1);
INSERT INTO wfp_visualization_type VALUES (3, 'Gaps', 1, 1, 'http://syriainfo.cartodb.doylesolutions.ie/api/v2/viz/7b56c4f6-9fce-11e4-8004-005056821820/viz.json', 0);
INSERT INTO wfp_visualization_type VALUES (4, 'Partners', 1, 1, 'http://syriainfo.cartodb.doylesolutions.ie/api/v2/viz/7b56c4f6-9fce-11e4-8004-005056821820/viz.json', 0);
INSERT INTO wfp_visualization_type VALUES (2, 'Active', 1, 1, 'http://syriainfo.cartodb.doylesolutions.ie/api/v2/viz/4757b414-cd6c-11e4-a593-005056821820/viz.json', 0);
INSERT INTO wfp_visualization_type VALUES (6, 'WFP Lebanon', 1, 1, 'http://syriainfo.cartodb.doylesolutions.ie/api/v2/viz/c3c4d7d4-7a0b-11e4-a1e1-005056821820/viz.json', 0);
INSERT INTO wfp_visualization_type VALUES (5, 'Jordan V', 3, 1, 'http://syriainfo.cartodb.doylesolutions.ie/api/v2/viz/c1863bf6-b751-11e4-84b2-005056821820/viz.json', 1);


--
-- Name: wfp_visualization_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('wfp_visualization_type_id_seq', 6, true);


--
-- Name: wfp_admin_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_admin
    ADD CONSTRAINT wfp_admin_pk PRIMARY KEY (id);


--
-- Name: wfp_country_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_country
    ADD CONSTRAINT wfp_country_pkey PRIMARY KEY (id);


--
-- Name: wfp_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_group
    ADD CONSTRAINT wfp_group_pkey PRIMARY KEY (id);


--
-- Name: wfp_layers_level_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_layers_level
    ADD CONSTRAINT wfp_layers_level_pkey PRIMARY KEY (id);


--
-- Name: wfp_layers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_layers
    ADD CONSTRAINT wfp_layers_pkey PRIMARY KEY (id);


--
-- Name: wfp_org_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_org
    ADD CONSTRAINT wfp_org_pkey PRIMARY KEY (id);


--
-- Name: wfp_user_country_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_user_country
    ADD CONSTRAINT wfp_user_country_pkey PRIMARY KEY (id);


--
-- Name: wfp_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_user_group
    ADD CONSTRAINT wfp_user_group_pkey PRIMARY KEY (id);


--
-- Name: wfp_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_user
    ADD CONSTRAINT wfp_user_pkey PRIMARY KEY (id);


--
-- Name: wfp_visualization_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY wfp_visualization_type
    ADD CONSTRAINT wfp_visualization_type_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

