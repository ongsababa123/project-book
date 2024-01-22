<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Generate PDF</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url('<?php echo base_url('public/fonts/THSarabunNew.ttf'); ?>') format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url('<?php echo base_url('public/fonts/THSarabunNew Bold.ttf'); ?>') format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url('<?php echo base_url('public/fonts/THSarabunNew Italic.ttf'); ?>') format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url('<?php echo base_url('public/fonts/THSarabunNew BoldItalic.ttf'); ?>') format('truetype');
        }

        body {
            font-family: 'THSarabunNew', sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>


<body>
    <div class="container mt-5">
        <h2>Generate PDF in Codeigniter from View</h2>
        <div class="d-flex flex-row-reverse bd-highlight">
            <a href="<?php echo base_url('dashboard/report/generate/pdf') ?>" class="btn btn-primary">
                Download PDF
            </a>
        </div>
        <table class="table table-striped table-hover mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Profile</th>
                    <th>City</th>
                    <th>Date</th>
                    <th>CTC</th>
                    <th>CTC</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ฟหกฟหกฟหกฟ</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>33</td>
                    <td>ฟหกฟหกหฟ/11/28</td>
                    <td>$162,700</td>
                </tr>
                <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009/10/09</td>
                    <td>$1,200,000</td>
                </tr>
                <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                </tr>
                <tr>
                    <td>Bradley Greer</td>
                    <td>Software Engineer</td>
                    <td>London</td>
                    <td>41</td>
                    <td>2012/10/13</td>
                    <td>$132,000</td>
                </tr>
                <tr>
                    <td>Brenden Wagner</td>
                    <td>Software Engineer</td>
                    <td>San Francisco</td>
                    <td>28</td>
                    <td>2011/06/07</td>
                    <td>$206,850</td>
                </tr>
                <tr>
                    <td>Brielle Williamson</td>
                    <td>Integration Specialist</td>
                    <td>New York</td>
                    <td>61</td>
                    <td>2012/12/02</td>
                    <td>$372,000</td>
                </tr>
                <tr>
                    <td>Bruno Nash</td>
                    <td>Software Engineer</td>
                    <td>London</td>
                    <td>38</td>
                    <td>2011/05/03</td>
                    <td>$163,500</td>
                </tr>
                <tr>
                    <td>Caesar Vance</td>
                    <td>Pre-Sales Support</td>
                    <td>New York</td>
                    <td>21</td>
                    <td>2011/12/12</td>
                    <td>$106,450</td>
                </tr>
                <tr>
                    <td>Cara Stevens</td>
                    <td>Sales Assistant</td>
                    <td>New York</td>
                    <td>46</td>
                    <td>2011/12/06</td>
                    <td>$145,600</td>
                </tr>
                <tr>
                    <td>Cedric Kelly</td>
                    <td>Senior Javascript Developer</td>
                    <td>Edinburgh</td>
                    <td>22</td>
                    <td>2012/03/29</td>
                    <td>$433,060</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>