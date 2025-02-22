<?php
    
    function myRenderTable(){
        // Directory where saved TXT files are stored
        $dataDir = "data/";

        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0777, true);
        }

        // Get all saved template files
        $templateFiles = glob($dataDir . "*.txt");

        if (count($templateFiles) > 0){ 
            $tbl = '';
            $ctr=1;
            foreach ($templateFiles as $file){
                $filename = basename($file, ".txt"); // Extract filename without extension
                $createdTime = date("Y-m-d H:i:s", filemtime($file)); // Get file creation date
                $pdfUrl = "pdf_Generate.php?pdf_title=" . urlencode($filename); 

                $tbl .= "<tr scope=\"row\">";
                $tbl .= "<td>$ctr</td><td>".htmlspecialchars($filename)."</td>";
                $tbl .= "<td>".$createdTime."</td>";
                $tbl .= "<td><i class=\"far fa-edit editRow\" data-placement=\"top\" title=\"Edit this item\"></i>
                            <i class=\"far fa-eye\" onclick=\"window.open('".$pdfUrl."', 'PDF Preview', 'width=800,height=600')\" data-placement=\"top\" title=\"Preview this item\"></i>
                        <a href=\"".$pdfUrl."'&download=1'\" download=\"".$filename.".pdf\" data-placement=\"top\" title=\"Download this item\"><i class=\"far fa-arrow-alt-circle-down\"></i></a>
                        
                        <i class=\"far fa-trash-alt deleteRow\" data-placement=\"top\" title=\"Delete this item\"></i></td>";
                        
                $tbl .= "</tr>";
                $ctr++;
            }
        }else{
            $tbl = "<tr><td colspan='4'>No templates saved yet.</td></tr>";
        }

        return $tbl;
    }

    $tblResults = myRenderTable();

    include_once("index.html.php");
?>