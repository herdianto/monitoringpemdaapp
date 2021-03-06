
-- SELECT TOTAL SCORE
SELECT result.id_pemda , pemda.nama_pemda , 
	AVG(((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)) AS totalscore
FROM pemda INNER JOIN result
ON result.id_pemda = pemda.id_pemda
GROUP BY id_pemda
ORDER BY `result`.`id_pemda` ASC

-- SELECT CURRENT DATE
SELECT result.id_pemda , pemda.nama_pemda , ((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575) AS totalscore FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE result.date = CURRENT_DATE() GROUP BY id_pemda ORDER BY `result`.`id_pemda` ASC

-- NO PAGERANK
SELECT result.id_pemda , pemda.nama_pemda , ((((sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971))*0.2341+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575) AS totalscore
FROM pemda INNER JOIN result
ON result.id_pemda = pemda.id_pemda
GROUP BY id_pemda
ORDER BY `result`.`id_pemda` ASC



--kelengkapan website
SELECT result.sejarah, result.frekuensi_aktif,result.frekuensi_update, result.date,result.id_pemda , pemda.nama_pemda,pemda.url ,
	
	(sejarah*0.1946+motto_daerah*0.1933+lambang*0.1983+lokasi*0.2122+visi_misi*0.2016)*0.1988+(pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971) AS kelengkapan_website, 
	
	AVG((((kelengkapan_website*0.2341)+SEO_pagerank*0.2393+frekuensi_update*0.2636+frekuensi_aktif*0.2630)*0.5425+ ((facebook*0.5+fu_facebook*0.5)*0.4778+(twitter*0.5+fu_twitter*0.5)*0.3667+(youtube*0.5+fu_youtube*0.5)*0.1556)*0.4575)) AS totalscore
	
FROM pemda INNER JOIN result 
ON result.id_pemda = pemda.id_pemda 
WHERE result.id_pemda =1 
GROUP BY result.date LIMIT 30

SELECT COUNT(pemda.nama_pemda) AS jumlah , 
(COUNT(pemda.nama_pemda)-(SUM(CASE WHEN pemda.url = "-" THEN 1 ELSE 0 END))) AS pemda_terdaftar FROM pemda;


--DETAIL.PHP
SELECT result.fu_twitter, result.fu_facebook,result.fu_youtube,result.sejarah, result.frekuensi_aktif,result.frekuensi_update, result.date,result.id_pemda , pemda.nama_pemda,pemda.url ,


(
	( ( 
		(sejarah*0.1946)+(motto_daerah*0.1933)+(lambang*0.1983)+(lokasi*0.2122)+(visi_misi*0.2016)
		)*0.1988 + (pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971)
	) * 0.3077)
		 as kelengkapan_website,
        
        round(
             ((
(
	( ( 
		(sejarah*0.1946)+(motto_daerah*0.1933)+(lambang*0.1983)+(lokasi*0.2122)+(visi_misi*0.2016)
		)*0.1988 + (pemerintahan_daerah*0.1946)+(geografi*0.2059)+(peraturan_daerah*0.2036)+(buku_tamu*0.1971)
	) * 0.3077) +
		(frekuensi_update*0.3465)+
		(frekuensi_aktif*0.3458)
		)* 0.5425) + 
        ((((facebook*0.5+fu_facebook*0.5)*0.4778)+((twitter*0.5+fu_twitter*0.5)*0.3667)+((youtube*0.5+fu_youtube*0.5)*0.1556))* 0.4575)
        ,2) as tot
                      

 FROM pemda INNER JOIN result ON result.id_pemda = pemda.id_pemda WHERE result.id_pemda =381 AND result.date = (SELECT MAX(result.date) FROM result)
                                                                                                                                               