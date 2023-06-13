<?php
require('./tfpdf/tfpdf.php');
if(isset($_GET['id'])){
    require_once "connect.php";
    $connect = new mysqli($host, $db_user, $db_pass, $db_name);
    $sql = "SELECT u.imie,u.nazwisko,u.nrprawojazdy, u.nrtelefon, u.miasto, u.ulica, u.lokal , c.marka, c.model, c.nrrejestracyjny, r.idreservation, r.data_start, r.data_koniec, r.ile_dni, r.potwierdzone as dni FROM car as c 
            INNER JOIN reservation as r ON c.idcar=r.idcar
            INNER JOIN user as u ON u.iduser=r.iduser WHERE r.idreservation=".$_GET['id'];
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }

    $a ='Imię i nazwisko/nazwa: '. $row['imie'].' '.$row['nazwisko'];
    $b ='Adres zam./siedziby: '.$row['ulica'].' '.$row['lokal'].' '.$row['miasto'];
    $c ='Nr. prawa jazdy: '.$row['nrprawojazdy'].',';
    $d = 'Telefon: '.$row['nrtelefon'].',';
    $e = 'Marka: '.$row['marka'].',';
    $f = 'Model: '.$row['model'].',';
    $g = 'Numer Rejestracyjny: '.$row['nrrejestracyjny'].',';
    $h = '1. Umowa zostaje zawarta na czas oznaczony, tj. od dnia '.$row['data_start'].' do dnia '.$row['data_koniec'].' .';

$pdf = new tFPDF();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);
$pdf->Ln();
$pdf->Cell(0,8,'UMOWA NAJMU SAMOCHODU',0,0,"C");
$pdf->Ln();
$pdf->SetFont('DejaVu','',11);
$pdf->Ln();
$pdf->Cell(0,8,'zawarta w dniu '.date("d.m.Y").'r. w Gdyni,');
$pdf->Ln();
$pdf->Cell(0,8,'pomiędzy:');
$pdf->Ln();
$pdf->Cell(0,8,'Imię i nazwisko/nazwa: CarSzer Sp.z.o.o,');
$pdf->Ln();
$pdf->Cell(0,8,'Adres zam./siedziby: Inżyniera Jana Śmidowicza 69, 81-127 Gdynia,');
$pdf->Ln();
$pdf->Cell(0,8,'Zwanym w dalszej części WYNAJMUJĄCYM');
$pdf->Ln();
$pdf->Cell(0,8,'a');
$pdf->Ln();
$pdf->Cell(0,8,$a);
$pdf->Ln();
$pdf->Cell(0,8,$b);
$pdf->Ln();
$pdf->Cell(0,8,$c);
$pdf->Ln();
$pdf->Cell(0,8,$d);
$pdf->Ln();
$pdf->Cell(0,8,'Zwanym w dalszej części umowy NAJEMCĄ.');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'§ 1',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,'Przedmiot umowy najmu',0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'1. Wynajmujący oświadcza, że jest właścicielem samochodu osobowego:');
$pdf->Ln();
$pdf->Cell(0,8,$e);
$pdf->Ln();
$pdf->Cell(0,8,$f);
$pdf->Ln();
$pdf->Cell(0,8,$g);
$pdf->Ln();
$pdf->Cell(0,8,'2. Rzecz będąca przedmiotem najmu jest w stanie technicznym idealnym.');
$pdf->Ln();
$pdf->Cell(0,8,'Stan techniczny przedmiotu najmu jest najemcy znany.');
$pdf->Ln();
$pdf->Cell(0,8,'3. Wynajmujący oświadcza, że na dzień podpisania niniejszej umowy samochód nie posiada uszkodzeń.');
$pdf->Ln();
$pdf->Cell(0,8,'4. Samochód w czasie trwania umowy musi posiadać obowiązkowe ubezpieczenie OC.');
$pdf->Ln();
$pdf->Cell(0,8,'5. Strony ustalają, że na czas trwania niniejszej umowy koszt ubezpieczenia OC pokrywa wynajmujący.');
$pdf->Ln();
$pdf->Cell(0,8,'Karę z UFG za brak OC pokryje strona obowiązana do zakupu polisy OC.');
$pdf->Ln();
$pdf->Cell(0,8,'6. Kwestie ubezpieczeń dobrowolnych (AC, Assistance, NNW, itd.) pozostają po stronie najemcy. ');
$pdf->Ln();
$pdf->Cell(0,8,'7. Koszty eksploatacyjne inne niż zakup paliwa pokrywa wynajmujący. ');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'§ 2',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,'Sposób użytkowania przedmiotu najmu',0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'1. Wynajmujący oddaje do używania rzecz, o której mowa w § 1 umowy, a najemca rzecz tę ');
$pdf->Ln();
$pdf->Cell(0,8,'przyjmuje w najem. ');
$pdf->Ln();
$pdf->Cell(0,8,'2. Rzecz zostanie przeznaczona przez Najemcę do jeżdżenia.');
$pdf->Ln();
$pdf->Cell(0,8,'3. Najemcy nie wolno dokonywać zmiany przeznaczenia najętej rzeczy, w ');
$pdf->Ln();
$pdf->Cell(0,8,'szczególności dokonywać przebudowy i innych przeróbek');
$pdf->Ln();
$pdf->Cell(0,8,'4. Najemcy nie wolno oddawać przedmiotu niniejszej umowy w podnajem lub do bezpłatnego używania.');
$pdf->Ln();
$pdf->Cell(0,8,'5. Wynajmujący zobowiązuje się do utrzymywania przedmiotu najmu przez cały czas trwania ');
$pdf->Ln();
$pdf->Cell(0,8,'umowy w stanie przydatnym do umówionego użytku.');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'§ 3',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,'Czas trwania umowy najmu',0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,$h);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'§ 4',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,'Wydanie przedmiotu najmu',0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'1. Odbędzie się najpóźniej do godziny 12:00 dnia rozpoczęcia najmu. ');
$pdf->Ln();
$pdf->Cell(0,8,'2. Przedmiot najmu zostanie przekazany w siedzibie firmy CarSzer Sp. z.o.o. ');
$pdf->Ln();
$pdf->Cell(0,8,'znajdującej się pod adresem: Inżyniera Jana Śmidowicza 69, 81-127 Gdynia');
$pdf->Ln();
$pdf->Cell(0,8,'3. Stan techniczny przedmiotu najmu zostanie potwierdzony w protokole przekazania. ');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'§ 5',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,'Kary umowne',0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'1. W przypadku częściowego lub całkowitego zniszczenia przedmiotu najmu przez najemcę, ');
$pdf->Ln();
$pdf->Cell(0,8,'najemca będzie obciążony kosztami naprawy przedmiotu najmu.');
$pdf->Ln();
$pdf->Cell(0,8,'2. W przypadku całkowitego zniszczenia karę umowną ustala się w wysokości wartości ');
$pdf->Ln();
$pdf->Cell(0,8,'pojazdu, tj. na dzień sporządzenia umowy najmu 100tyś zł.');
$pdf->Ln();
$pdf->Cell(0,8,'3. W przypadku częściowego zniszczenia przedmiotu najmu, karę umowną ustala się w ');
$pdf->Ln();
$pdf->Cell(0,8,'stopniu nieproporcjonalnym do skali zniszczeń, tj. 15% wartości pojazdu z dnia zawarcia ');
$pdf->Ln();
$pdf->Cell(0,8,'umowy za każdy 1% zniszczenia pojazdu. ');
$pdf->Ln();
$pdf->Cell(0,8,'4. Strony mogą ustalić skalę zniszczenia przedmiotu najmu we własnym zakresie. W ');
$pdf->Ln();
$pdf->Cell(0,8,'przypadku braku zgody co do rozmiaru zniszczeń, zostanie wynajęty rzeczoznawca samochodowy. ');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'§ 6',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,'Zwrot przedmiotu najmu',0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'1. Odbędzie się najpóźniej do godziny 12:00 dnia zakończenia najmu. ');
$pdf->Ln();
$pdf->Cell(0,8,'2. Przedmiot najmu zostanie przekazany w siedzibie firmy CarSzer Sp. z.o.o. ');
$pdf->Ln();
$pdf->Cell(0,8,'znajdującej się pod adresem: Inżyniera Jana Śmidowicza 69, 81-127 Gdynia');
$pdf->Ln();
$pdf->Cell(0,8,'3. Stan techniczny przedmiotu najmu zostanie sprawdzony z protokołem przekazania. ');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'§ 7',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,'1. Wszelkie zmiany niniejszej umowy wymagają formy pisemnej pod rygorem nieważności.');
$pdf->Ln();
$pdf->Cell(0,8,'2. W sprawach nieuregulowanych postanowieniami umowy stosowane będą przepisy Kodeksu cywilnego. ');
$pdf->Ln();
$pdf->Cell(0,8,'3. Wszelkie spory na tle wykonywania umowy rozstrzygać będzie sąd powszechny');
$pdf->Ln();
$pdf->Cell(0,8,'4. Koszty zawarcia niniejszej umowy ponosi najemca.');
$pdf->Ln();
$pdf->Cell(0,8,'6. Umowę sporządzono w dwóch jednobrzmiących egzemplarzach, dla wynajmującego i najemcy.');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'Umowę odczytano, zgodnie przyjęto i podpisano.');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,8,'NAJEMCA                                                                       WYNAJMUJĄCY');
$pdf->Ln();
$pdf->Cell(0,8,'................................                                                      ................................  ');
$pdf->Output(); 
}
else
echo('Błąd przekierowania musi być ?id=(idrezerwacja)');
?>