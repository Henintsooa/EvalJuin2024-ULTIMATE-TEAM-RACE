INSERT INTO "public".categorie( idcategorie, nomcategorie ) VALUES ( 1, 'Homme');
INSERT INTO "public".categorie( idcategorie, nomcategorie ) VALUES ( 2, 'Femme');
INSERT INTO "public".categorie( idcategorie, nomcategorie ) VALUES ( 3, 'Junior');
INSERT INTO "public".categorie( idcategorie, nomcategorie ) VALUES ( 4, 'Senior');
INSERT INTO "public".equipe( idequipe, identifiant, nomequipe, "password" ) VALUES ( 1, 'equipe1', 'Equipe 1', '123');
INSERT INTO "public".equipe( idequipe, identifiant, nomequipe, "password" ) VALUES ( 2, 'equipe2', 'Equipe 2', '123');
INSERT INTO "public".equipe( idequipe, identifiant, nomequipe, "password" ) VALUES ( 3, 'equipe3', 'Equipe 3', '123');
INSERT INTO "public".etape( idetape, nometape, longueur, nbcoureur, rang, heuredebut ) VALUES ( 1, 'Etape de Betsizaraina', 30.50, 2, 1, '2024-06-01 10:25:34 AM');
INSERT INTO "public".etape( idetape, nometape, longueur, nbcoureur, rang, heuredebut ) VALUES ( 3, 'Etape d''Ampasimbe', 35, 1, 3, '2024-06-01 03:00:01 PM');
INSERT INTO "public".etape( idetape, nometape, longueur, nbcoureur, rang, heuredebut ) VALUES ( 2, 'Etape de Vatomandry', 45, 2, 2, '2024-06-01 12:25:36 PM');
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 16, 1, 1, 10);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 17, 1, 2, 6);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 18, 1, 3, 4);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 19, 1, 4, 2);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 20, 1, 5, 1);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 26, 3, 1, 10);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 21, 2, 1, 10);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 22, 2, 2, 6);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 23, 2, 3, 4);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 24, 2, 4, 2);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 25, 2, 5, 1);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 27, 3, 2, 6);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 28, 3, 3, 4);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 29, 3, 4, 2);
INSERT INTO "public".etapepoints( idetapepoints, idetape, rang, points ) VALUES ( 30, 3, 5, 1);
INSERT INTO "public".migrations( id, migration, batch ) VALUES ( 1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO "public".migrations( id, migration, batch ) VALUES ( 2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO "public".migrations( id, migration, batch ) VALUES ( 3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO "public".sessions( id, user_id, ip_address, user_agent, payload, last_activity ) VALUES ( '8XU6riN7bdrRnrTZUpQolvSk2lZZNow95CleeFfQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN1RVaE04bXNLWldKcWlyNzEyR042Qm5peTF2RFZTMVBjQW5meEQ0MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGFzc2VtZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ291dCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1717359113);
INSERT INTO "public".sessions( id, user_id, ip_address, user_agent, payload, last_activity ) VALUES ( '6dbx5dIoCPKpoQ2435PS7AxAqrq8TPc8huJcOf1s', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSUZKQVVvRXc0TjVqc3NQVU9ndmpha2N1NmZnTzc4ZU5qQ2VLbmdwdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGFzc2VtZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJlcXVpcGUiO086MTc6IkFwcFxNb2RlbHNcRXF1aXBlIjozMDp7czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJwZ3NxbCI7czo4OiIAKgB0YWJsZSI7czo2OiJlcXVpcGUiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6ODoiaWRFcXVpcGUiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YTo0OntzOjg6ImlkZXF1aXBlIjtpOjE7czoxMToiaWRlbnRpZmlhbnQiO3M6NzoiZXF1aXBlMSI7czo5OiJub21lcXVpcGUiO3M6ODoiRXF1aXBlIDEiO3M6ODoicGFzc3dvcmQiO3M6MzoiMTIzIjt9czoxMToiACoAb3JpZ2luYWwiO2E6NDp7czo4OiJpZGVxdWlwZSI7aToxO3M6MTE6ImlkZW50aWZpYW50IjtzOjc6ImVxdWlwZTEiO3M6OToibm9tZXF1aXBlIjtzOjg6IkVxdWlwZSAxIjtzOjg6InBhc3N3b3JkIjtzOjM6IjEyMyI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTM6InVzZXNVbmlxdWVJZHMiO2I6MDtzOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMToiACoAZmlsbGFibGUiO2E6Mzp7aTowO3M6OToibm9tRXF1aXBlIjtpOjE7czoxMToiaWRlbnRpZmlhbnQiO2k6MjtzOjg6InBhc3N3b3JkIjt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dvdXQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1717397438);
INSERT INTO "public".users( id, name, email, email_verified_at, "password", status, remember_token, created_at, updated_at ) VALUES ( 1, 'admin', 'admin@gmail.com', null, '$2y$12$LqVfgHNYrlZ8DQE94W7eY.oqSYs3c86xaiCx5TpLtkl9mUOmzqbCu', 'admin', null, '2024-06-01 06:10:18 AM', '2024-06-01 06:10:18 AM');
INSERT INTO "public".users( id, name, email, email_verified_at, "password", status, remember_token, created_at, updated_at ) VALUES ( 2, 'Equipe 1', 'equipe1@gmail.com', null, '$2y$12$VCzzuf8tyiC7qSdc9Ynmk.fl2MCVDXFQFXCzQgUhDbLrndKvqDpgm', 'user', null, '2024-06-01 08:44:02 AM', '2024-06-01 08:44:02 AM');
INSERT INTO "public".users( id, name, email, email_verified_at, "password", status, remember_token, created_at, updated_at ) VALUES ( 3, 'Equipe 2', 'equipe2@gmail.com', null, '$2y$12$B7EjY6/BtGybPACkSU2VNuK85I55kKEEiF83FYdmv4EDgbieVc9wi', 'user', null, '2024-06-01 08:44:33 AM', '2024-06-01 08:44:33 AM');
INSERT INTO "public".users( id, name, email, email_verified_at, "password", status, remember_token, created_at, updated_at ) VALUES ( 4, 'Equipe 3', 'equipe3@gmail.com', null, '$2y$12$BFK.1Fn4i/WHlWyulQhXB.Zd3spvRP5ybqV8ZDZhpaGXcR3UxHday', 'user', null, '2024-06-01 08:45:52 AM', '2024-06-01 08:45:52 AM');
INSERT INTO "public".coureur( idcoureur, nomcoureur, numero, genre, datenaissance, idequipe ) VALUES ( 1, 'Lova', '1', 'M', '1990-01-01', 1);
INSERT INTO "public".coureur( idcoureur, nomcoureur, numero, genre, datenaissance, idequipe ) VALUES ( 2, 'Sabrina', '2', 'F', '1995-11-01', 1);
INSERT INTO "public".coureur( idcoureur, nomcoureur, numero, genre, datenaissance, idequipe ) VALUES ( 4, 'Vero', '12', 'F', '1990-06-01', 3);
INSERT INTO "public".coureur( idcoureur, nomcoureur, numero, genre, datenaissance, idequipe ) VALUES ( 6, 'Jill', '22', 'F', '1995-03-01', 3);
INSERT INTO "public".coureur( idcoureur, nomcoureur, numero, genre, datenaissance, idequipe ) VALUES ( 3, 'Justin', '11', 'M', '2006-05-01', 2);
INSERT INTO "public".coureur( idcoureur, nomcoureur, numero, genre, datenaissance, idequipe ) VALUES ( 5, 'John', '21', 'M', '1990-02-01', 2);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 1, 1, 1);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 2, 1, 2);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 5, 3, 1);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 11, 2, 1);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 12, 2, 2);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 13, 1, 3);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 14, 1, 5);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 15, 2, 3);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 16, 2, 5);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 17, 3, 3);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 18, 1, 4);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 19, 1, 6);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 20, 2, 4);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 21, 2, 6);
INSERT INTO "public".etapecoureur( idetapecoureur, idetape, idcoureur ) VALUES ( 22, 3, 4);
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 19, 6, 1, '02:25:00', '2024-06-01 10:25:34 AM', '2024-06-01 12:50:34 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 18, 4, 1, '02:14:26', '2024-06-01 10:25:34 AM', '2024-06-01 12:40:00 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 16, 5, 1, '02:19:26', '2024-06-01 10:25:34 AM', '2024-06-01 12:45:00 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 15, 3, 1, '02:04:26', '2024-06-01 10:25:34 AM', '2024-06-01 12:30:00 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 14, 2, 1, '02:05:00', '2024-06-01 10:25:34 AM', '2024-06-01 12:30:34 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 13, 1, 1, '02:00:01', '2024-06-01 10:25:34 AM', '2024-06-01 12:25:35 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 29, 4, 3, '10:29:59', '2024-06-01 03:00:01 PM', '2024-06-02 01:30:00 AM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 28, 3, 3, '10:14:59', '2024-06-01 03:00:01 PM', '2024-06-02 01:15:00 AM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 26, 1, 3, '09:59:59', '2024-06-01 03:00:01 PM', '2024-06-02 01:00:00 AM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 25, 6, 2, '02:59:59', '2024-06-01 12:25:36 PM', '2024-06-01 03:25:35 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 24, 4, 2, '02:54:24', '2024-06-01 12:25:36 PM', '2024-06-01 03:20:00 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 23, 5, 2, '03:14:24', '2024-06-01 12:25:36 PM', '2024-06-01 03:40:00 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 22, 3, 2, '03:04:24', '2024-06-01 12:25:36 PM', '2024-06-01 03:30:00 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 21, 2, 2, '02:49:24', '2024-06-01 12:25:36 PM', '2024-06-01 03:15:00 PM');
INSERT INTO "public".resultatcoureur( idresultatcoureur, idcoureur, idetape, duree, heuredebut, heurefin ) VALUES ( 20, 1, 2, '02:34:24', '2024-06-01 12:25:36 PM', '2024-06-01 03:00:00 PM');
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 1, 1, 1);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 2, 2, 2);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 3, 3, 1);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 4, 4, 2);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 5, 5, 1);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 6, 6, 2);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 7, 1, 4);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 8, 2, 4);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 9, 3, 3);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 10, 4, 4);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 11, 5, 4);
INSERT INTO "public".categoriecoureur( idcategoriecoureur, idcoureur, idcategorie ) VALUES ( 12, 6, 4);