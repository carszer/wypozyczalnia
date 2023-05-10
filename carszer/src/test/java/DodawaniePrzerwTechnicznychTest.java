import org.junit.jupiter.api.*;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.*;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Date;
import java.util.List;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertTrue;

public class DodawaniePrzerwTechnicznychTest {

    private WebDriver driver;

    @BeforeEach
    public void setUp() {

        //Określenie warunków wstępnych
        //inicjacja drivera
        System.setProperty("webdriver.chrome.driver", "src/main/resources/chromedriver.exe");
        driver = new ChromeDriver();
        //nawigacja pod wskazany adres
        driver.navigate().to("https://carszer.bialystok.pl/admin.php");
        // Logowanie jako administrator
        // Szukanie elementu strony o danej nazwie
        WebElement emailInput = driver.findElement(By.name("email"));
        //Wprowadzenie wartości w wyżej wyszukane miejsce
        emailInput.sendKeys("1@wp.pl");
        WebElement passwordInput = driver.findElement(By.name("password"));
        passwordInput.sendKeys("zaq1@WSX");
        WebElement submitButton = driver.findElement(By.name("admin_btn"));
        submitButton.click();
        // Upewnienie się, że jesteśmy w panelu administratora, porównanie tytułu jaki powinien być z tytułem z driver'a
        assertEquals("CarSzer-Panel administratora", driver.getTitle(), "Nie jestes w panelu admina");
        //Po upewnieniu się, przechodzi na wskazany URL do przerw technicznych
        driver.navigate().to("https://carszer.bialystok.pl/adminDashPrzerwaTech.php");
    }

    @Test
    public void testDodawaniePrzerwyTechnicznej() {

        //Kolejne porównanie tytułu oczekiwanego z tym z driver'a
        assertEquals("CarSzer-Panel administratora", driver.getTitle(), "Nie jestes w panelu admina");
        //wyszukanie el. wybierz auto
        WebElement wybierzAuto = driver.findElement(By.name("car"));
        //wybrany samochod z listy
        wybierzAuto.sendKeys("lada 2107");
        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd.MM.yyyy");
        //pobranie aktualnej daty
        LocalDate przerwaOd = LocalDate.now();
        //I dodanie 2 dni naprzod
        LocalDate przerwaDo = przerwaOd.plusDays(2);
        //wyszukanie pól przerwa od i do
        WebElement przerwaOdInput = driver.findElement(By.name("dataod"));
        przerwaOdInput.sendKeys(przerwaOd.format(formatter));
        WebElement przerwaDoInput = driver.findElement(By.name("datado"));
        przerwaDoInput.sendKeys(przerwaDo.format(formatter));
        WebElement submit = driver.findElement(By.name("submit"));
        submit.click();

        // Sprawdzenie, czy przerwa techniczna została dodana poprawnie

        WebElement przerwyTable = driver.findElement(By.className("table"));

        int index = 0;
        List<WebElement> tableRows = przerwyTable.findElements(By.tagName("tr"));
        tableRows.get(index).getText();
        int i = 0;
        DateTimeFormatter formatter2 = DateTimeFormatter.ofPattern("yyyy-MM-dd");

        for (WebElement tr: tableRows
             ) {

            List<WebElement> row = tr.findElements(By.tagName("td"));
            if (i>0) {
                String model = row.get(0).getAttribute("innerHTML");
                String marka = row.get(1).getAttribute("innerHTML");
                String dataOd = row.get(2).getAttribute("innerHTML");
                String dataDo = row.get(3).getAttribute("innerHTML");
                String modelMarka = model + " " + marka;


                if("lada 2107" == modelMarka)
                if(dataOd == przerwaOd.format(formatter2))
                if(dataDo == przerwaDo.format(formatter2)){
                    assertEquals("lada 2107", modelMarka);
                    assertEquals(dataOd, przerwaOd.format(formatter2));
                    assertEquals(dataDo, przerwaDo.format(formatter2));
                }
            }
            i++;
    }
    }
    @AfterEach
    public void tearDown() {
        driver.quit();
    }
}
