<?php
session_start();
if(!isset($_SESSION['stu_name']) && $_SESSION['stu_name']=='')
{
    header("location:index.php");
    exit;
}
$api_key='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';

$code=$_POST['code'];
$language=$_POST['language'];

if(isset($_POST['code']) && $_POST['code']=='')
{
    echo "You didnot provide any code snippet!!\nI can analyse based on your provided code!!\nCODEVERSE!!";
    exit;
}

$prompt = "Analyze the following $language code snippet and provide its time complexity in the Best Case , Average Case and Worst Case. Mention each case in each paragraph. Donot Provide the code just analyze. :\n\n" . $code;

// Initialize cURL
$ch = curl_init();
// Set the API endpoint
curl_setopt($ch, CURLOPT_URL, "https://api.groq.com/openai/v1/chat/completions");
// Set the request method to POST
curl_setopt($ch, CURLOPT_POST, 1);
// Set the request headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $api_key",
    "Content-Type: application/json"
]);
// Set the request body
$data = [
    "model" => "llama3-8b-8192",
    "messages" => [
        [
            "role" => "user", 
            "content" => $prompt
        ]
    ]
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
// Return the response instead of printing
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Execute the request
$response = curl_exec($ch);
$responseData = json_decode($response, true);
// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode and print the response
    echo $responseData['choices'][0]['message']['content'];
}
// Close the cURL session
curl_close($ch);
?>
