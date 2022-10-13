import 'dart:async';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http; //show get;
import 'dart:convert';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData(
        primarySwatch: Colors.deepOrange,
      ),
      home: MyHomePage(),
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({Key? key}) : super(key: key);
  @override
  _MyHomePageState createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  Future GetContactData() async {
    var url =
        'https://www.savemysunday.com/s&v/index.php'; //voir si il faut index.php ou lecture.php
    var response = await http.get(Uri.parse(url));
    return json.decode(response.body);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: FutureBuilder(
          future: GetContactData(),
          builder: (context, snapshot) {
            if (snapshot.hasError) print(snapshot.error);
            return snapshot.hasData
                ? ListView.builder(
                    itemCount: snapshot.data.length,
                    itemBuilder: (context, index) {
                      List list = snapshot.data;
                      return Card(
                        margin: EdgeInsets.all(10),
                        elevation: 20,
                        shape: RoundedRectangleBorder(
                            side: BorderSide(color: Colors.green, width: 3),
                            borderRadius:
                                BorderRadius.all(Radius.circular(15))),
                        shadowColor: Colors.green[100],
                        child: Column(mainAxisSize: MainAxisSize.min,
                            // debut insert
                            children: [
                              Image.network("${list[index]['illustration']}",
                                  width: 70.0, height: 100.0),
                              Text(list[index]['sommaire']),
                            ]

                            // fin insert
                            ),
                      );
                    })
                : Center(
                    child: CircularProgressIndicator(),
                  );
          }),
    );
  }
}
