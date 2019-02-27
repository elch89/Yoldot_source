<?php /*Template name: Hospitals compare*/ ?>
<!DOCTYPE html>
<html>
<link href="css/comp_hos.css" type="text/css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type='text/javascript' src='js/comp_hos.js'></script>

<?php
/* $servername = "XXXXXXXXXXXX";
 * $username = "XXXXXXXXXXX";
 * $password = "XXXXXXXXXXXXXXXXX";

--- Create connection
 * $conn = mysqli_connect($servername, $username, $password);

--- Check connection
 * if (!$conn) {
 *   die("Connection failed: " . mysqli_connect_error());
 * }
 */

//TODO: validate table not empty and exit script 
global $wpdb;
//Count number of collumns (count() for num of rows!)
$count = "SELECT COUNT(*)
       FROM INFORMATION_SCHEMA.COLUMNS
       WHERE table_schema = 'yoldotle_uprdb1'
             AND table_name = 'hospitals_comp'";
//returns how many hospitals in database
$numCol=$wpdb->get_var($count);
//get columns names
$colName = $wpdb->get_results("SHOW COLUMNS FROM hospitals_comp",ARRAY_N);

////////////////////
$myrows = $wpdb->get_results( "SELECT * FROM hospitals_comp WHERE id = 2 " ,ARRAY_N );
// Get location - mercaz darom etc.
$mylocation = $wpdb->get_results( "SELECT * FROM hospitals_comp WHERE id = 1 " ,ARRAY_N );

$visible = '';
 ?>
   
 <form method="post" action="" <?php 
   									if(isset($_POST['SubmitButton'])){
   											$visible= 'class="vis"';
                                      		echo $visible;
 									}
									?>>
	<br><h2>השווי בין 2 או 3 בתי חולים:</h2>
     <div class= 'hos-sel'>
	<?php
      	$previous = '';
		$first_group = true;
    	echo "<label class='dropdown'><select  name='first'><option value='' disabled selected>בחרי בית חולים</option>";
            for ( $i=3 ; $i<$numCol ; $i++ ) 
            { 
              	
              	if($mylocation[0][$i] != $previous)
                {
                  	if(!$first_group){
                 		echo "</optgroup>"; 
                	}
                  	else{
                     	$first_group = false; 
                    }
                 	echo '<optgroup label="'.$mylocation[0][$i].'">';
                }
                echo '<option value="'.$colName[$i][0].'">' . $myrows[0][$i]. '</option>';
              	$previous = $mylocation[0][$i];
              /*testing: echo "<script>console.log( 'Debug Objects: " . $mylocation[0][$i] . "' );</script>";*/
           	}
		$previous = '';
		$first_group = true;
    	echo "</optgroup></select></label><p class='sep'>או</p><label class='dropdown'><select  name='sec' ><option value='' disabled selected>בחרי בית חולים</option>";
		for ( $i=3 ; $i<$numCol ; $i++ ) 
        { 
          	if($mylocation[0][$i] != $previous)
            {
                if(!$first_group){
                 	echo "</optgroup>"; 
                }
                else{
                    $first_group = false; 
                }
                echo '<optgroup label="'.$mylocation[0][$i].'">';
            }
            echo '<option value="'.$colName[$i][0].'">' . $myrows[0][$i]. '</option>';
          	$previous = $mylocation[0][$i];
        }
		$previous = '';
		$first_group = true;    	
		echo "</optgroup></select></label><p class='sep'>או</p><label class='dropdown'><select  name='third' ><option value='' disabled selected>בחרי בית חולים</option>";
		for ( $i=3 ; $i<$numCol ; $i++ ) 
        { 
          	if($mylocation[0][$i] != $previous)
            {
                if(!$first_group){
                 	echo "</optgroup>"; 
                }
                else{
                    $first_group = false; 
                }
                echo '<optgroup label="'.$mylocation[0][$i].'">';
            }
            echo '<option value="'.$colName[$i][0].'">' . $myrows[0][$i]. '</option>';
          	$previous = $mylocation[0][$i];
        }
    	echo "</optgroup></select></label><br/>";



?>
	
	
  </div>
	<br><h2>מה מעניין אותך לדעת?</h2>
	 <input type="checkbox" class="chk_boxes" value="checkedAll"  /><label for="checkedAll">בחרי הכל</label><br/><br/>
    <input class="chk_boxes1"  type="checkbox" name="categ[]" value="Minhal" /><label for="Minhal">נתונים מנהלתיים</label><br/>
      <div class = "smaller"><p title="מהו גודל מחלקת חדרי לידה"> מס' לידות בחודש </p> <p title="מהו גודל מחלקת חדרי לידה"> מס' חדרי לידה </p></div>
	  <div class = "smaller"> <p title="עד כמה המיילדת תהיה זמינה לתמוך בך ולזהות מצבי סיכון"> מיילדות במשמרת </p> <p title="עד כמה המיילדת תהיה זמינה לתמוך בך ולזהות מצבי סיכון"> מס' יולדות למיילדת </p></div>
    <input class="chk_boxes1"  type="checkbox" name="categ[]" value="Melavim"  /><label for="Melavim">מלווים</label><br/>
	<div class="row">
      <div class = "smaller"><p title="כמה מלווים יכולו להתלוות אליך ללידה שלך">מס' מלווים בחדר לידה</p> <p title="מספר המלווים שיוכלו להכנס איתך לחדר מיון">מס' מלווים במיון</p> <p title="לפי חוק זכויות החולה, מטופלת זכאית לנוכחות מלווה בעת טיפול רפואי, לפי בחירתה. האם זכות זו מכובדת בעת החדרת אפידורל?">לווי במתן זריקת אפידורל</p></div> 
	  <div class = "smaller"><p title="לפי חוק זכויות החולה, מטופלת זכאית לנוכחות מלווה בעת טיפול רפואי, לפי בחירתה. האם זכות זו מכובדת בעת פרוצדורה של ואקום?">ליווי בלידת ואקום</p><p title="לפי חוק זכויות החולה, מטופלת זכאית לנוכחות מלווה בעת טיפול רפואי, לפי בחירתה. האם זכות זו מכובדת בזמן ניתוח מתוכנן?">לווי בניתוח מתוכנן</p> <p title="לפי חוק זכויות החולה, מטופלת זכאית לנוכחות מלווה בעת טיפול רפואי, לפי בחירתה. האם זכות זו מכובדת בזמן ניתוח לא מתוכנן?">ליווי בניתוח לא מתוכנן</p></div>
	  </div>
    <input class="chk_boxes1"  type="checkbox" name="categ[]" value="Nehalim"  /><label for="Nehalim">נהלים </label><br/>
		<div class="row">
		<div class = "smaller"><p title="ניטור הינו מעקב אחר דופק לב העבור לבחינת מצבו וכן אחר צירי האשה.  המלצת ארגון הבריאות העולמי היא לבצע ניטור לסרוגין לנשים בריאות בלידה ספונטנית טבעית. מה יציעו לך בלידה? ניטור רציף או ניטור לסרוגין- בפרקי זמן קבועים המאפשרים לך להתקלח ולנוע בחופשיות  ">ניטור בלידה טבעית ללא גורמי סיכון</p> <p title="המלצת משרד הבריאות בשלב הלידה פעילה היא- ניטור כל חצי שעה למשך דקה ובשלב השני - כל רבע שעה למשך דקה מיד לאחר ציר">תדירות ומשך ניטור</p><p title="ארגון הבריאות העולמי ממליץ על ניטור עם דופלר או סטטסקופ לב העובר. בישראל לרב הניטור עם מוניטור המקובע לבטן באמצעות חגורה">אמצעי ניטור</p>
		<p title="לפי הנחיות משרד הבריאות, יש לפתוח וריד לכל אשה המגיעה ללדת, זאת כדי לאפשר החדרת תרופות באופן מהיר ויעיל, אם תזדקק לכך בהמשך הלידה. במקרה של דימום חריג, לעיתים קשה לפתוח וריד במהירות בעקבות שקיעת הורידים. כמו כן פתיחת הוריד נעשית לקבלת מידע על סוג הדם וסקר">פתיחת וריד כנוהל בלידה טבעית</p> </div>
    	<div class = "smaller"><p title="בדיקה פנימית, וגינלית, בה המיילדת נוגעת בצוואר הרחם על מנת להעריך את מידת הפתיחה והמחיקה (התרככות) וכך להעריך את התקדמות הלידה">בדיקות פתיחה בלידה טבעית</p> <p title="המלצת ארגון הבריאות העולמי היא לאפשר לנשים לאכול ולשתות. משרד הבריאות ממליץ על שתיה קלה כפי רצונה של היולדת">אוכל ושתיה</p><p title="האם המיילדות מנוסות בקבלת הלידה במגוון תנוחות , לפי בחירת היולדת">תמיכה בתנוחות שונות</p> <p title="האם ישנה דלת הניתנת לסגירה מעבר לוילון הסגור? האם יש דלת ללא וילון?">פרטיות</p></div>
		</div>
    <input class="chk_boxes1"  type="checkbox" name="categ[]" value="Zman"  /><label for="Zman">זמנים</label><br/>
	<div class="row">
      <div class = "smaller"><p title='לפי הנחיות האיגוד הישראלי למילדות וגניקולוגיה: "בשבוע 40 ניתן להשרות לידה אם קיימים תנאים צוואריים המתאימים לכך" " הנתונים העכשווים מצביעים על יתרון קטן בהשראת לידה החל משבוע 41 בהריונות בסיכון נמוך, עם תארוך מדויק" ובהמשך" ניתן להמתין ללידה ספונטנית עד שבוע 42 כיוון שהעליה בסיכון האבסולוטי לסיבוכים שונים הינו נמוך ביותר". בבתי חולים רבים מקדימים להציע השראת לידה כבר בשבוע 40, גם כשאין גורמי סיכון נוספים, קיימים הבדלים בין בתי החולים השונים וכן ההמלצה משתנה ממטפל/ת למטפל/ת.'>שבוע המלצה להשראת לידה בגין הריון 'עודף'</p> <p title="כשליש מהלידות מתחילות בירידת מים ללא צירים. המלצת משרד הבריאות היא להגיע להשגחה תוך שעתיים מירידת המים. אצל רב הנשים תחל לידה ספונטנית בתוך 24 השעות הראשונות לאחר ירידת מים. קיימת שונות בולטת בין בתי חולים בנוגע להמלצה על מועד תחילת זרוז כימי עם פיטוצין. ">זירוז אחרי ירידת מים</p></div>
	  <div class = "smaller"><p title="השלב השני בלידה: מפתיחה מלאה של צוואר הרחם ועד צאת התינוק. (לעיתים נקרא: שלב הלחיצות) בלידה ראשונה עשוי לקחת יותר זמן, ואפידורל יכול אף הלעריך את משך הזמן הנ"ל. לאחר פרק זמן מסוים יציעו לך בבית החולים פיטוצין, ואקום, או ניתוח קיסרי"> זמן לשלב השני בלידה ראשונה </p> <p title="השלב השני בלידה: מפתיחה מלאה ועד צאת התינוק. שימוש באפידורל יכול להאריך את משך השלב השני ולכן ההמלצות משתנות מלידה טבעית ללידה עם אפידורל. לאחר פרק זמן מסוים יציעו לך בבית החולים עזרה או התערבות (ואקום, ניתוח). לעיתים תוצע התערבות עוד בטרם חלוף הזמן המצוין ותחל התערבות כימית של פיטוצין כדי להמנע משהוי הלידה בהמשך">זמן לשלב השני בלידה חוזרת</p></div>
	  </div>
    <input class="chk_boxes1"  type="checkbox" name="categ[]" value="Emtsaim"  /><label for="Emtsaim">אמצעים שונים ללידה טבעית </label><br/>
	<div class="row">
      <div class = "smaller"><p title="מקלחת ואמבטיה יכולים לסייע כאמצעי לשיכוך כאבים. המצאותם בקרבתך, יבטיחו את פרטיותך המקסימלית ותחושת הנוחות שלך בלידה">מקלחת, אמבטיה</p>  <p title="כדור לידה, תומך בתנועתיות מעגלית תוך ישיבה נוחה ובהתבססות התינוק באגן ומקל על ההתכווצויות הרחם"> כדור פיזיו </p><p title="מאפשר תנועתיות בלידה מאולחשת"> בוטן </p> <p title="תערובת של הגזים חמצן דו-חנקני וחמצן נקי. בעל השפעה מרגיעה, מפחית כאב וחרדה"> גז צחוק </p> <p title="שרפרף מעוגל התומך בירכייך, אך ריק ביניהן. הוא מאפשר לך לכרוע בנוחות ולאורך זמן מבלי להתעייף, וכך להעזר בכוח המשיכה בשלב יציאת התינוק. "> כסא לידה </p> </div>
	  <div class = "smaller"><p title="מוניטור המאפשר ליולדת הזקוקה לניטור רציף במהלך הלידה להיות בתנועה, ולעיתים אף להכנס לאמבטיה או מקלחת"> מוניטור אלחוטי </p><p title="מיילדת המלווה אותך באופן פרטי ורציף במהלך ההריון, בלידה ולאחריה. מחקרים מראים כי טיפול פרטני של מיילדת ליולדת הינו מיטבי עבור תחושת היולדת ותוצאות הלידה ליולדת ולתינוק"> מיילדת פרטית </p> <p title="מרכז לידה טבעית אלו חדרי לידה המנוהלים על ידי מיילדות עם נהלים שונים מחדרי הלידה הרגילים. חדר לידה טבעי הוא חדר שיש בו אביזרים התומכים בלידה טבעית. לעיתים בחדרים אלו הנהלים גמישים יותר."> חדר לידה טבעית/ מרכז לידה טבעית </p><p title="משרד הבריאות הורה על הנחיות לניהול לידה טבעיתת ואף המליץ על החתמת היולדות על התנאים ללידה טבעית. קיימים חדרי לידה עם פרוטוקול ללידה טבעית המכתיב את התנאים לקיום לידה טבעית והאמצעים לביצועה (בעיקר גמישות בנושא הניטור).  חלקם אף מחתימים את היולדת על הסכמה ללידה טבעית תוך  הדגשת "הסיכונים הכרוכים בלידה טבעית" . לפעמים יש דרישה להחתמה בפני רופא ולפעמים בפני רופא או מיילדת."> פרוטוקול לידה טבעית בכל החדרים </p> <p> שונות </p></div>
	  </div>
	<input class="chk_boxes1"  type="checkbox" name="categ[]" value="Meyuhad"  /><label for="Meyuhad">לידות מיוחדות</label><br/>
      <div class="row">
	  <div class = "smaller"><p title="מהם התנאים ללידת תאומים רגילה (לא בניתוח)- באילו מצגים צריכים התינוקות להמצא, היכן תערך הלידה- בחדר ניתוח או בחדר לידה רגיל, האם יש דרישה לאפידורל או המלצה לא מחייבת?">לידת תאומים</p> <p title="האם מתאפשרת לידת עכוז ובאילו תנאים ניתן לקיימה, בחדר לידה או בחדר ניתוח, האם יש דרישה לאפידורל או המלצה לא מחייבת?"> לידת עכוז </p></div>
      <div class = "smaller"><p title="ההמלצה הרפואית היום היא לעודד לידה רגילה לאחר ניתוח קיסרי. מהי גישת בית החולים לנושא?"> לידה נרתיקית לאחר קיסרי (VBAC) </p> <p title="האם קיימת אפשרות ללידה רגילה כשברקע יותר מניתוח קיסרי אחד?"> לידה נרתיקית לאחר 2 ניתוחים קיסריים (VBAC 2) </p></div>
	  </div>
	<input class="chk_boxes1"  type="checkbox" name="categ[]" value="Keysari"  /><label title="ניתוח קיסרי בגישה ידידותית לתינוק וליולדת בו מאפשרים: ליווי ליולדת בניתוח, בלי קשירת הידיים; הנמכת הפרגוד במהלך הוצאת התינוק המאפשר לאשה לראותו יוצא, וכן הוצאה הדרגתית שלא תהיה טראומטית לתינוק. עור לעור והנקה בחדר ניתוח, וכן התאוששות משותפת של התינוק ואמו לאחר הניתוח." for="Keysari">קיסרי ידידותי</label><br/>
		<div class="row">
		<div class = "smaller"><p>המנעות מקשירת ידיים</p> <p>פרגוד שקוף / ללא פרגוד </p><p>הוצאת תינוק הדרגתית </p> </div>
	  <div class = "smaller"><p>עור לעור בחדר ניתוח </p> <p>הנקה בחדר ניתוח </p><p></p></div>
	  </div>
	<input class="chk_boxes1"  type="checkbox" name="categ[]" value="Aharey"  /><label for="Aharey">אחרי הלידה</label><br/>
      <div class="row">
	  <div class = "smaller"><p title="האם קיים נוהל להשהיית חיתוך חבל הטבור לאחר לידת התינוק? כמה ממתינים מצאת התינוק ועד לניתוק חבל הטבור? האם היולדת צריכה לבקש זאת או שההשהיה תבוצע על פי הנוהל הקיים">השהיית חיתוך חבל הטבור</p> <p title="לפי הנחיות משרד הבריאות יש לתת לכל יולדת פיטוצין לכיווץ הרחם ולהפחתת דימום לאחר צאת התינוק. אולם בלידה טבעית, לאשה המסרבת ינתן הסבר ויוצעו לה אמצעים חלופיים כמו עסוי פטמות והנקה. כמו כן קיימת הנחיה למעקב צמוד יותר אחר הדימום במקרה של סרוב לקבלת פיטוצין. מה היחס של בתי החולים לבקשה להמנעות מקבלת התרופה, כל עוד אין מצב רפואי המעיד על הצורך בכך">פיטוצין לכיווץ הרחם </p> </div>
	  <div class = "smaller"> <p title="כאשר התינוק נמצא עם אמו גם במהלך הלילה, אך מגיע לתינוקיה לבדיקות בלעדיה."> ביות מלא </p> <p> טיפולים אלטרנטיבים </p></div>
	  </div>
  <br/> <input class="chk_boxes1" type="checkbox" name="chadrey" value="Cheder"  /><label for="Cheder" style="font-size:20px;">פרטים על חדרי לידה טבעית</label><br/><br/>
	<div class='btn-back'><input type="submit" name="SubmitButton" value="חיפוש"/></div>
 </form>

 <div class="limiter">
		<div <?php if(isset($_POST['SubmitButton'])){ echo 'class="container-table100"';}?> >
			<div class="wrap-table100">
				<div class="table100">
       
<?php

/*names of categories - Minhal, Melavim, Nehalim, Zman, Emtsaim, Meyuhad, Aharey
 Cheder-*/

if(isset($_POST['SubmitButton']) ){
  	$hosAmmount=3;
	if(isset($_POST['first']) && isset($_POST['sec']) && (isset($_POST['categ']) || isset($_POST['chadrey']))){
      	
  		$firstHos = $_POST['first'];
		$secondHos = $_POST['sec'];
      	if(isset($_POST['third'])){
        	$thirdHos = $_POST['third'];
          	$comma= ", ";
        }
      	else {
          $thirdHos = $comma ="";
        }
      	
      	$tempArr=array();
      	$tempArr = $_POST['categ'];
      	
      	
      	$is_checked = false;
      	$equ= 'category = ';
      	$category.=$equ;
      	for($i=0;$i<sizeof($tempArr) ;$i++){
          if(!$is_checked){
            $category.="'".$tempArr[$i]."'";
            $is_checked=true;
          }
          else{
            $category.= ' OR '.$equ; 
            $category.="'".$tempArr[$i]."'";
          }
        }
// Chadrey leida quary
      $cheder = '';
      if(isset($_POST['chadrey'])){
      	$cheder = $wpdb->get_results("SELECT title, $firstHos, $secondHos $comma $thirdHos FROM hospitals_comp WHERE category = 'Cheder'");
      }
	  $rows = $wpdb->get_results( "SELECT title, $firstHos, $secondHos $comma $thirdHos FROM hospitals_comp WHERE $category" );
      $hosNames = $wpdb->get_results("SELECT title, $firstHos, $secondHos $comma $thirdHos FROM hospitals_comp WHERE id = 2");
  
     echo "<div class='btn-back'>";
      if(isset($_POST['SubmitButton'])){
          		echo "<form method='post'><input  name='retgo' type='submit' value = 'לחיפוש חדש' /></form>";
        		}
      echo "</div>";
		echo "<div id='table-container'><table border='1' id='table-1'>
    		<thead class='table100-head'><tr><th class = 'columnT'>".$hosNames[0]->title."</th>
        	<th class = 'column'>".$hosNames[0]->$firstHos." </th>
        	<th class = 'column'>".$hosNames[0]->$secondHos."</th>";
      		if(isset($_POST['third'])){
              $hosAmmount=4;
        		echo "<th class = 'column'>". $hosNames[0]->$thirdHos."</th>";
            }
      	echo "</thead><tbody>";
		$temp=0;
    // output data of each row
   		foreach($rows as $row) {
          if($temp>0){
       		echo "<tr><td class = 'columnT'> " . $row->title. "</td><td class = 'column'>" . isVX($row->$firstHos) . "</td><td class = 'column'>" . isVX($row->$secondHos) ."</td>";
            if(isset($_POST['third'])){
              	
            	echo "<td class = 'column'> ". isVX($row->$thirdHos) ."</td>";
            }
            echo "</tr>";
          }
           $temp++;
    	}
      	if(isset($_POST['chadrey'])){//if chadrey leida selected
      		echo "<tr><td class = 'chadreyTitle' colspan=".$hosAmmount.">חדרי לידה טבעית</td></tr>";
          	foreach($cheder as $rooms) {
          		echo "<tr><td class = 'columnT'> " . $rooms->title. "</td><td class = 'column'>" . isVX($rooms->$firstHos) . "</td><td class = 'column'>" . isVX($rooms->$secondHos) ."</td>";
            	if(isset($_POST['third'])){
            		echo "<td class = 'column'>". isVX($rooms->$thirdHos) ."</td>";
            	}
            	echo "</tr>";
            }
      	}
    	echo "</tbody></table><div id='bottom_anchor'></div></div>";
	}
  else if(!isset($_POST['first']) || !isset($_POST['sec'])){
  		echo "<span style='color:red ; font-weight:bold;'>* יש לבחור בתי חולים</span><br>";
	}
  if(!isset($_POST['categ']) && !isset($_POST['chadrey']))
 		echo "<span style='color:red; font-weight:bold;'>*  יש לבחור נתונים</span>";
}

?>
			</div >
  		<div class='btn-back'><?php if(isset($_POST['SubmitButton'])){
          		echo "<form method='post'><input name='retgo' type='submit' value = 'לחיפוש חדש' /></form>";
        		}?></div>
		</div >
	</div >
  </div >
  
</body>
 <?php
 	function foo(){//unset all variables
       		unset($_POST['SubmitButton']);
       		unset($_POST['chadrey']);
      		unset($_POST['caetg']);
        	unset($_POST['first']);
        	unset($_POST['sec']);
        	unset($_POST['third']);
          	$visible = '';
        }
	function isVX($selected){
		if($selected == "V"){
			return "<span style = 'color:green'>✓</span>";
		}
		else if($selected == "X"){
			return "<span style = 'color:red'>✘</span>";
		}
		else{
			return $selected;
		}
	}
	
	if(isset($_POST['retgo'])){foo();unset($_POST['retgo']);}

 ?>

 
  <!--<?php mysqli_close($conn); ?>-->

</html>