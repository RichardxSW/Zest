PGDMP  ,        
            |            Zest    16.3    16.3 [    e           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            f           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            g           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            h           1262    24576    Zest    DATABASE     }   CREATE DATABASE "Zest" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE "Zest";
                postgres    false            �            1259    24633    category    TABLE       CREATE TABLE public.category (
    id bigint NOT NULL,
    kategori character varying(255) NOT NULL,
    jumlah integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    total_products integer DEFAULT 0 NOT NULL
);
    DROP TABLE public.category;
       public         heap    postgres    false            �            1259    24632    category_id_seq    SEQUENCE     x   CREATE SEQUENCE public.category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.category_id_seq;
       public          postgres    false    226            i           0    0    category_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.category_id_seq OWNED BY public.category.id;
          public          postgres    false    225            �            1259    24730    customer    TABLE     O  CREATE TABLE public.customer (
    id bigint NOT NULL,
    nama_customer character varying(255) NOT NULL,
    address_customer character varying(255),
    email_customer character varying(255),
    contact_customer character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.customer;
       public         heap    postgres    false            �            1259    24729    customer_id_seq    SEQUENCE     x   CREATE SEQUENCE public.customer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.customer_id_seq;
       public          postgres    false    236            j           0    0    customer_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.customer_id_seq OWNED BY public.customer.id;
          public          postgres    false    235            �            1259    24742 	   disposals    TABLE     "  CREATE TABLE public.disposals (
    id bigint NOT NULL,
    kategori_produk character varying(255) NOT NULL,
    nama_produk character varying(255) NOT NULL,
    jumlah_produk integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.disposals;
       public         heap    postgres    false            �            1259    24741    disposals_id_seq    SEQUENCE     y   CREATE SEQUENCE public.disposals_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.disposals_id_seq;
       public          postgres    false    238            k           0    0    disposals_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.disposals_id_seq OWNED BY public.disposals.id;
          public          postgres    false    237            �            1259    24609    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    24608    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    222            l           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    221            �            1259    24578 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    24577    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216            m           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    24595    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    24602    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         heap    postgres    false            �            1259    24621    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    24620    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    224            n           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    223            �            1259    24640    product    TABLE     x  CREATE TABLE public.product (
    id bigint NOT NULL,
    nama_produk character varying(255) NOT NULL,
    harga_produk double precision NOT NULL,
    jumlah_produk integer NOT NULL,
    kategori_produk character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    total_sales integer DEFAULT 0 NOT NULL
);
    DROP TABLE public.product;
       public         heap    postgres    false            �            1259    24639    product_id_seq    SEQUENCE     w   CREATE SEQUENCE public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.product_id_seq;
       public          postgres    false    228            o           0    0    product_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;
          public          postgres    false    227            �            1259    24706    selling    TABLE     h  CREATE TABLE public.selling (
    id bigint NOT NULL,
    product_name character varying(255) NOT NULL,
    category_name character varying(255) NOT NULL,
    customer_name character varying(255) NOT NULL,
    quantity integer NOT NULL,
    date date NOT NULL,
    status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT selling_status_check CHECK (((status)::text = ANY ((ARRAY['pending'::character varying, 'approved'::character varying, 'declined'::character varying])::text[])))
);
    DROP TABLE public.selling;
       public         heap    postgres    false            �            1259    24705    selling_id_seq    SEQUENCE     w   CREATE SEQUENCE public.selling_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.selling_id_seq;
       public          postgres    false    232            p           0    0    selling_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.selling_id_seq OWNED BY public.selling.id;
          public          postgres    false    231            �            1259    24668    supplier    TABLE     F  CREATE TABLE public.supplier (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    address character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    contact character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.supplier;
       public         heap    postgres    false            �            1259    24667    supplier_id_seq    SEQUENCE     x   CREATE SEQUENCE public.supplier_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.supplier_id_seq;
       public          postgres    false    230            q           0    0    supplier_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.supplier_id_seq OWNED BY public.supplier.id;
          public          postgres    false    229            �            1259    24717    totalpurchase    TABLE     i  CREATE TABLE public.totalpurchase (
    id bigint NOT NULL,
    product_name character varying(255) NOT NULL,
    supplier_name character varying(255) NOT NULL,
    quantity integer NOT NULL,
    in_date date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    category character varying(255),
    status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    CONSTRAINT totalpurchase_status_check CHECK (((status)::text = ANY ((ARRAY['pending'::character varying, 'approved'::character varying, 'declined'::character varying])::text[])))
);
 !   DROP TABLE public.totalpurchase;
       public         heap    postgres    false            �            1259    24716    totalpurchase_id_seq    SEQUENCE     }   CREATE SEQUENCE public.totalpurchase_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.totalpurchase_id_seq;
       public          postgres    false    234            r           0    0    totalpurchase_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.totalpurchase_id_seq OWNED BY public.totalpurchase.id;
          public          postgres    false    233            �            1259    24585    users    TABLE     �  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    role character varying(255)
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    24584    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    218            s           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    217            �           2604    24636    category id    DEFAULT     j   ALTER TABLE ONLY public.category ALTER COLUMN id SET DEFAULT nextval('public.category_id_seq'::regclass);
 :   ALTER TABLE public.category ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    225    226            �           2604    24733    customer id    DEFAULT     j   ALTER TABLE ONLY public.customer ALTER COLUMN id SET DEFAULT nextval('public.customer_id_seq'::regclass);
 :   ALTER TABLE public.customer ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    235    236    236            �           2604    24745    disposals id    DEFAULT     l   ALTER TABLE ONLY public.disposals ALTER COLUMN id SET DEFAULT nextval('public.disposals_id_seq'::regclass);
 ;   ALTER TABLE public.disposals ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    238    237    238            �           2604    24612    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222            �           2604    24581    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    216    216            �           2604    24624    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    224    223    224            �           2604    24643 
   product id    DEFAULT     h   ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);
 9   ALTER TABLE public.product ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    228    228            �           2604    24709 
   selling id    DEFAULT     h   ALTER TABLE ONLY public.selling ALTER COLUMN id SET DEFAULT nextval('public.selling_id_seq'::regclass);
 9   ALTER TABLE public.selling ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    232    232            �           2604    24671    supplier id    DEFAULT     j   ALTER TABLE ONLY public.supplier ALTER COLUMN id SET DEFAULT nextval('public.supplier_id_seq'::regclass);
 :   ALTER TABLE public.supplier ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    230    229    230            �           2604    24720    totalpurchase id    DEFAULT     t   ALTER TABLE ONLY public.totalpurchase ALTER COLUMN id SET DEFAULT nextval('public.totalpurchase_id_seq'::regclass);
 ?   ALTER TABLE public.totalpurchase ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    233    234    234            �           2604    24588    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            V          0    24633    category 
   TABLE DATA           `   COPY public.category (id, kategori, jumlah, created_at, updated_at, total_products) FROM stdin;
    public          postgres    false    226   (n       `          0    24730    customer 
   TABLE DATA           �   COPY public.customer (id, nama_customer, address_customer, email_customer, contact_customer, created_at, updated_at) FROM stdin;
    public          postgres    false    236   �n       b          0    24742 	   disposals 
   TABLE DATA           l   COPY public.disposals (id, kategori_produk, nama_produk, jumlah_produk, created_at, updated_at) FROM stdin;
    public          postgres    false    238   �n       R          0    24609    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    222   �n       L          0    24578 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    216   o       O          0    24595    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    219   �p       P          0    24602    password_resets 
   TABLE DATA           C   COPY public.password_resets (email, token, created_at) FROM stdin;
    public          postgres    false    220   �p       T          0    24621    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    224   �p       X          0    24640    product 
   TABLE DATA           �   COPY public.product (id, nama_produk, harga_produk, jumlah_produk, kategori_produk, created_at, updated_at, total_sales) FROM stdin;
    public          postgres    false    228   q       \          0    24706    selling 
   TABLE DATA           �   COPY public.selling (id, product_name, category_name, customer_name, quantity, date, status, created_at, updated_at) FROM stdin;
    public          postgres    false    232   �q       Z          0    24668    supplier 
   TABLE DATA           ]   COPY public.supplier (id, name, address, email, contact, created_at, updated_at) FROM stdin;
    public          postgres    false    230   cr       ^          0    24717    totalpurchase 
   TABLE DATA           �   COPY public.totalpurchase (id, product_name, supplier_name, quantity, in_date, created_at, updated_at, category, status) FROM stdin;
    public          postgres    false    234   �r       N          0    24585    users 
   TABLE DATA           {   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) FROM stdin;
    public          postgres    false    218   Gs       t           0    0    category_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.category_id_seq', 10, true);
          public          postgres    false    225            u           0    0    customer_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.customer_id_seq', 26, true);
          public          postgres    false    235            v           0    0    disposals_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.disposals_id_seq', 1, false);
          public          postgres    false    237            w           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    221            x           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 26, true);
          public          postgres    false    215            y           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    223            z           0    0    product_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.product_id_seq', 17, true);
          public          postgres    false    227            {           0    0    selling_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.selling_id_seq', 66, true);
          public          postgres    false    231            |           0    0    supplier_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.supplier_id_seq', 5, true);
          public          postgres    false    229            }           0    0    totalpurchase_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.totalpurchase_id_seq', 4, true);
          public          postgres    false    233            ~           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 4, true);
          public          postgres    false    217            �           2606    24638    category category_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public            postgres    false    226            �           2606    24737    customer customer_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.customer
    ADD CONSTRAINT customer_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.customer DROP CONSTRAINT customer_pkey;
       public            postgres    false    236            �           2606    24749    disposals disposals_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.disposals
    ADD CONSTRAINT disposals_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.disposals DROP CONSTRAINT disposals_pkey;
       public            postgres    false    238            �           2606    24617    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    222            �           2606    24619 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    222            �           2606    24583    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            �           2606    24601 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    219            �           2606    24628 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    224            �           2606    24631 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    224            �           2606    24647    product product_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    228            �           2606    24715    selling selling_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.selling
    ADD CONSTRAINT selling_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.selling DROP CONSTRAINT selling_pkey;
       public            postgres    false    232            �           2606    24675    supplier supplier_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.supplier
    ADD CONSTRAINT supplier_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.supplier DROP CONSTRAINT supplier_pkey;
       public            postgres    false    230            �           2606    24724     totalpurchase totalpurchase_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.totalpurchase
    ADD CONSTRAINT totalpurchase_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.totalpurchase DROP CONSTRAINT totalpurchase_pkey;
       public            postgres    false    234            �           2606    24594    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    218            �           2606    24592    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    218            �           1259    24607    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public            postgres    false    220            �           1259    24629 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    224    224            V   P   x�e�!�0Pݞ�����X�f9v
!���a_���'))4'Ԥ�"5 Q|2ia qwP���oȓ4��X��@F      `   H   x�32��H�K)J�����4202�50�52W04�20�21�&�ed���W��U����)������9W� J��      b      x������ � �      R      x������ � �      L   �  x����n� E���Tؘ��K%D����Qտ��I!�H��r�k/(�,Hh���c�.{�%���}�/ ��	\]J�!N6���᯿4Q���*�`��e=)�ܼ���	��7�lO7�	|�pq�u��S���c��d4A=h��#į���eH*I�)1Lۘ+j�;����n)�>�,�����D��U��${U�Mۺ.s�I TK�r�κi�2��\"����S�����"��1,�8���Z:e%Ձ���e�/;�	0��5�~]k[�8�v��F/������6�bZ��C��'U�[
)���g� N�V�v[��)Ot��ꟴ�-�F�����{���� �I3����:E�Gx|A�!��_Ӹ�e%�=��:�Ӝ��j}Q$�^�߅�\<      O      x������ � �      P      x������ � �      T      x������ � �      X   �   x�u�=�0Fg��@Q�g�	!�,"�*��I�x��,=Y8�y��1�����V�(3H7(/�E��R�L"��鐦������^����k$�G�Ę�t�Q�Gv���k��hZ$���5-`{/�i1�x�l����_<�>l      \   �   x��ν
�0����*z���$=[����&�h�jiK��w��EZ�l���C�˽��Ч	���@KmK��v���g�~Z���'��f�@����o�|'�a�"��p�#-�͓F�Ur�!�5�g(��ZOV�[M��7�[��2$՟��e'�xU8T�      Z      x������ � �      ^   �   x�}��
�0�s�}�I���	qz�ݐ�ԢV��-8�T4����O0)+,�aw>T�J��t��P�:%�f�;#�-�N�kY�Y��r�a�_]�:ހ��U�Zo+Q;�N�k��5�|೜Ƃ!��C���09RߙVO�a�{�ݬ���z:pZ����/�B�MZc      N   6  x�m��n�@�5<�30����E�k�)3N� *}�*.j7�&'��_�.y��N(��1��e�Mi�.u���`��3�H��ʎN�eaz6H����	&v����T����
���m_��B��ta�,��v-a�d$h�s�>ʺ���	1��&`��A�VÈ!��N�'������b�p(`~2��Q�����$��<�Q��,��d=�F���y-؞�	�7^E�Hƒh(o�(i��C���j��	��28s�������˱��lpq�_ݯ�F�v^��t�F9�wB^Y�GQ�)     