<?php
$url = "http://api.wolframalpha.com/v2/query?input=what+day+is+it+today&appid=YOUR_APP_ID_HERE&format=plaintext&podtitle=Result";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
ob_start();
curl_exec($ch);
curl_close($ch);
$contents = ob_get_contents();
ob_end_clean();
echo $contents;


/*
<?xml version='1.0' encoding='UTF-8'?>
<queryresult success='true'
    error='false'
    numpods='6'
    datatypes='City,Country,Leader,People,USState'
    timedout=''
    timing='2.685'
    parsetiming='0.436'
    parsetimedout='false'
    recalculate=''
    id='MSP664419ii17e963a79ch500004cbei5i8b191b862&amp;s=23'
    related='http://www3.wolframalpha.com/api/v2/relatedQueries.jsp?id=MSP664519ii17e963a79ch5000026264d1284ce0966&amp;s=23'
    version='2.1'>
 <pod title='Input interpretation'
     scanner='Identity'
     id='Input'
     position='100'
     error='false'
     numsubpods='1'>
  <subpod title=''>
   <plaintext>United States | President</plaintext>
  </subpod>
 </pod>
 <pod title='Result'
     scanner='Identity'
     id='Result'
     position='200'
     error='false'
     numsubpods='1'
     primary='true'>
  <subpod title=''
      primary='true'>
   <plaintext>Barack Obama</plaintext>
  </subpod>
 </pod>
 <pod title='Basic information'
     scanner='Data'
     id='BasicInformation:LeaderData'
     position='300'
     error='false'
     numsubpods='1'>
  <subpod title=''>
   <plaintext>official position | President (44th)
country | United States
political affiliation | Democrat
start date | January 20, 2009 (2 years 11 months 23 days ago)</plaintext>
  </subpod>
 </pod>
 <pod title='Sequence'
     scanner='Data'
     id='LeaderSequence:LeaderData'
     position='400'
     error='false'
     numsubpods='1'>
  <subpod title=''>
   <plaintext>January 2009  to  present | Barack Obama (Democrat)
January 2001  to  January 2009  (8 years) | George W. Bush (Republican)
January 1993  to  January 2001  (8 years) | Bill Clinton (Democrat)
January 1989  to  January 1993  (4 years) | George H.W. Bush (Republican)
January 1981  to  January 1989  (8 years) | Ronald Reagan (Republican)</plaintext>
  </subpod>
  <states count='1'>
   <state name='More'
       input='LeaderSequence:LeaderData__More' />
  </states>
 </pod>
 <pod title='Personal information'
     scanner='Data'
     id='LeaderDataPersonalInformationPod:PeopleData'
     position='500'
     error='false'
     numsubpods='2'>
  <subpod title=''>
   <plaintext>full name | Barack Hussein Obama II
date of birth | August 4, 1961 (age: 50 years)
place of birth | Honolulu, Hawaii, United States</plaintext>
  </subpod>
  <subpod title='Timeline'>
   <plaintext></plaintext>
  </subpod>
 </pod>
 <pod title='Image'
     scanner='Data'
     id='Image:PeopleData'
     position='600'
     error='false'
     numsubpods='1'>
  <subpod title=''>
   <plaintext></plaintext>
  </subpod>
 </pod>
 <sources count='3'>
  <source url='http://www.wolframalpha.com/sources/CountryDataSourceInformationNotes.html'
      text='Country data' />
  <source url='http://www.wolframalpha.com/sources/LeaderDataSourceInformationNotes.html'
      text='Leader data' />
  <source url='http://www.wolframalpha.com/sources/PeopleDataSourceInformationNotes.html'
      text='People data' />
 </sources>
</queryresult>





<?xml version='1.0' encoding='UTF-8'?>
<queryresult success='true'
    error='false'
    numpods='1'
    datatypes='City,DateObject,Holiday'
    timedout=''
    timing='1.989'
    parsetiming='0.198'
    parsetimedout='false'
    recalculate=''
    id='MSP360619ii19h8h5gc645100005a8i6b127h4f978b&amp;s=64'
    related='http://www4c.wolframalpha.com/api/v2/relatedQueries.jsp?id=MSP360719ii19h8h5gc6451000014d96b6fd2a242aa&amp;s=64'
    version='2.1'>
 <pod title='Result'
     scanner='Identity'
     id='Result'
     position='200'
     error='false'
     numsubpods='1'
     primary='true'>
  <subpod title=''
      primary='true'>
   <plaintext>Thursday, January 12, 2012</plaintext>
  </subpod>
 </pod>
</queryresult>
*/
?>
