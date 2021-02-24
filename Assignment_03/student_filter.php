<?php
    // Assignment requirement: 
    //- একটি স্টুডেন্ট এরে ডাটা দৈরি করুন যেখানে প্রায় ২০ জন এর ডাটা থাকবে এবং সেখানে থেকে শুরু মিরপুরের এবং বনানীর বাসিন্দাদের ডাটা প্রিন্ট করুন
    
    $students=[
        [
        'name' => 'Barsha',
        'age'  => '15',
        'cell' => '01912367601',
        'address'=>'Mirpur'
        ],
        [
        'name' => 'Rifah',
        'age'  => '14',
        'cell' => '01812393602',
        'address'=>'Kolabagan'
        ],
        [
        'name' => 'Mashrar',
        'age'  => '16',
        'cell' => '01719875604',
        'address'=>'Dhanmondi'
        ],
        [
        'name' => 'Nihan',
        'age'  => '05',
        'cell' => '01712654607',
        'address'=>'Banani'
        ],
        [
        'name' => 'Anan',
        'age'  => '11',
        'cell' => '01712344321',
        'address'=>'Banani'
        ],
        [
        'name' => 'Nazifa',
        'age'  => '18',
        'cell' => '01712341234',
        'address'=>'Banani'
        ],
        [
        'name' => 'Sadek',
        'age'  => '20',
        'cell' => '01712398745',
        'address'=>'Banani'
        ],
        [
        'name' => 'Mitul',
        'age'  => '19',
        'cell' => '01712335789',
        'address'=>'Banani'
        ],
        [
        'name' => 'Labiba',
        'age'  => '19',
        'cell' => '01713164609',
        'address'=>'Uttara'
        ],
        [
        'name' => 'Musarrat',
        'age'  => '20',
        'cell' => '01712394370',
        'address'=>'Bashundhara'
        ],
        [
        'name' => 'Munira',
        'age'  => '11',
        'cell' => '01825645611',
        'address'=>'Dhanmondi'
        ],
        [
        'name' => 'Tahira',
        'age'  => '16',
        'cell' => '01712362512',
        'address'=>'Badda'
        ],
        [
        'name' => 'Farhan',
        'age'  => '22',
        'cell' => '0171278951',
        'address'=>'Gabtoli'
        ],
        [
        'name' => 'sabbir',
        'age'  => '17',
        'cell' => '01712335764',
        'address'=>'Mirpur'
        ],
        [
        'name' => 'Rakib',
        'age'  => '12',
        'cell' => '01712789655',
        'address'=>'Uttara'
        ],
        [
        'name' => 'Simanto',
        'age'  => '19',
        'cell' => '01712385263',
        'address'=>'Baridhara'
        ],
        [
        'name' => 'Kibria',
        'age'  => '21',
        'cell' => '01712679617',
        'address'=>'Gazipur'
        ],
        [
        'name' => 'Rubel',
        'age'  => '20',
        'cell' => '01712365478',
        'address'=>'Uttara'
        ],
        [
        'name' => 'shahriar',
        'age'  => '24',
        'cell' => '01956248519',
        'address'=>'Banani'
        ],
        [
        'name' => 'Sadiya',
        'age'  => '23',
        'cell' => '01719173645',
        'address'=>'Gazipur'
        ]
    ];

    // I know i could have done everything in one function, but i wanted to test out the callback behavior in PHP, this allows us to separate the filter logic
    function filterStudentArray($students, $callbackCondition){
        $newArray = [];
        foreach ($students as $student) {
            if($callbackCondition($student)){
                array_push($newArray, $student);
            }
        }
        return $newArray;
    };

    $filtered = filterStudentArray($students, function($student){
        $address = strtolower($student['address']);
        return $address == 'banani' || $address == 'mirpur';
    });
    
    echo "<pre>";
    print_r($filtered);
?>