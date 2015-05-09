package com.androidapp.traffic;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Typeface;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends Activity {
	
	

    @Override
    public void onCreate(Bundle savedInstanceState) 
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        
        Button getReportButton = (Button) findViewById(R.id.trafficreportbutton);
        Button getDirectionsButton=(Button) findViewById(R.id.directionsbuttons);
        Button reportTraffic = (Button) findViewById(R.id.submittrafficreport);
        TextView tv = (TextView) findViewById(R.id.textView1);
        
        Typeface clouds = Typeface.createFromAsset(getAssets(), "contm.ttf");
        
        
        tv.setTypeface(clouds);
        getReportButton.setTypeface(clouds);
        reportTraffic.setTypeface(clouds);
      
    	
    	getReportButton.setOnClickListener(new OnClickListener()
        { 
        //On Click function
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(MainActivity.this,Report.class);
            startActivity(it);     
              
        }
            
        });
    	
    	getDirectionsButton.setOnClickListener(new OnClickListener()
        { 
        //On Click function
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(MainActivity.this,EndDirection.class);
            startActivity(it);     
              
        }
            
        });
    	
    	reportTraffic.setOnClickListener(new OnClickListener()
        { 
        //On Click function
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(MainActivity.this,Submit.class);
            startActivity(it);     
              
        }
            
        });
        
        
        
        
        
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
}
