/*===========Maxmentor===========*/
/*=======www.maxmentor.in========*/
/*======Telegram @maxmentor========*/
/*===========Github @maxmentor===========*/


<?php

/*  Fill this with your actual access token */
$x_access_token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwbGF0Zm9ybV9jb2RlIjoiV2ViQCQhdDM4NzEyIiwiaXNzdWVkQXQiOiIyMDI0LTEyLTA5VDIzOjUxOjE2LjEzMVoiLCJwcm9kdWN0X2NvZGUiOiJ6ZWU1QDk3NSIsInR0bCI6ODY0MDAwMDAsImlhdCI6MTczMzc4ODI3Nn0.19r48X2ouK_qdLfc31UVltJwAQxwTP_GVjO30LDWsUw";
$authorization_token = "eyJraWQiOiJkZjViZjBjOC02YTAxLTQ0MWEtOGY2MS0yMDllMjE2MGU4MTUiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJGOTQxMDRBOS03NEEwLTQ3NUQtQkIyRS01NjY3MDFBQTczMTgiLCJkZXZpY2VfaWQiOiI4YTUxMGViMy0xOTU5LTRhMmUtODgwMy00OGFhOWU3YzhmNTAiLCJhbXIiOlsiZGVsZWdhdGlvbiJdLCJ0YXJnZXRlZF9pZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6Ly91c2VyYXBpLnplZTUuY29tIiwidmVyc2lvbiI6MTAsImNsaWVudF9pZCI6InJlZnJlc2hfdG9rZW4iLCJhdWQiOlsidXNlcmFwaSIsInN1YnNjcmlwdGlvbmFwaSIsInByb2ZpbGVhcGkiLCJnYW1lLXBsYXkiXSwidXNlcl90eXBlIjoiUmVnaXN0ZXJlZCIsIm5iZiI6MTczMzgyMTgwMiwidXNlcl9pZCI6ImY5NDEwNGE5LTc0YTAtNDc1ZC1iYjJlLTU2NjcwMWFhNzMxOCIsInNjb3BlIjpbInVzZXJhcGkiLCJzdWJzY3JpcHRpb25hcGkiLCJwcm9maWxlYXBpIl0sInNlc3Npb25fdHlwZSI6IkdFTkVSQUwiLCJleHAiOjE3MzQxNjc0MDIsImlhdCI6MTczMzgyMTgwMiwianRpIjoiNWI3YTNlZjktYWFmYy00YjViLTllMjctZDBkYmY1NGZhZTgwIn0.g5C23AH6KSHU3Q5h5aA5vMDT1Qb9gc-l5eQ8MgcfMt-msyo38yNxmEd7xLBuIhmWKBYvyy-deB-8kfvbjWY5sEGVG2PuKQ8DNE0lGU5MGAiWeo-rI-CAqn-Zxk4dldqKAuDPoNkywowiBSh6Fh0de00Yul69OyuFAsI8lw5gCrk1EZTi3E2rpMHHmyjN3G0OWDvD-4p-olEwc9pgcOy9NLBmDzKEOnSiJucAjgYeHdYjSTZKthYe-ZpywQzyd7CHJjDlPbT8nsQgGWfM5-QolrTJ_MqcwXKNnrF9XbThCg8Bk_sccYZDXzIb2bAWwqe_lIFci-ujVPIFyGA-qTb1Vw";

if (isset($_GET["id"])) {
    $channel = $_GET["id"];
} else {
    exit("Error: Channel ID not found.");
}

$curl = curl_init();

$url="https://spapi.zee5.com/singlePlayback/getDetails/secure?channel_id=$channel&device_id=9bea555b-c43b-47dd-b02b-40476086152f&platform_name=desktop_web&translation=en&user_language=en,hi,hr,pa&country=IN&state=DL&app_version=4.14.2&user_type=premium&check_parental_control=false&gender=Unknown&version=12";

curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "application/json",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{
        "x-access-token": "' . $x_access_token. '",
        "Authorization": "' . $authorization_token . '"
    }',
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
]);

$response = curl_exec($curl);

if ($response === false) {
    exit("cURL Error: " . curl_error($curl));
}

curl_close($curl);

$zx = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    exit("JSON Decode Error: " . json_last_error_msg());
}

if (isset($zx["keyOsDetails"]) && isset($zx["keyOsDetails"]["video_token"])) {
    $playit = $zx["keyOsDetails"]["video_token"];

    header("Location: $playit");
} else {
    exit("Error: Api Response Error.");
}

?>
