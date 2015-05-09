package com.androidapp.traffic;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.Typeface;
import android.location.Address;
import android.location.Criteria;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.TextView;
import android.widget.Toast;

public class Report extends Activity implements LocationListener {
	   private WebView browser;


	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.report);
		 
		

        Button reportTraffic = (Button) findViewById(R.id.trafficreportbutton);
        Button endDirection=(Button)findViewById(R.id.directionsbutton);
        endDirection.setOnClickListener(new OnClickListener()
        { 
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(Report.this,EndDirection.class);
            startActivity(it);     
              
        }
            
        });
        
        reportTraffic.setOnClickListener(new OnClickListener()
        { 
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(Report.this,Submit.class);
            startActivity(it);     
              
        }
            
        });
        
        
        browser = (WebView)findViewById(R.id.webView2);
        browser.setWebViewClient(new MyBrowser());
	      String url = "http://m.justincoding.com/trafficProject/index.php";
	      browser.getSettings().setLoadsImagesAutomatically(true);
	      browser.getSettings().setJavaScriptEnabled(true);
	      browser.setScrollBarStyle(View.SCROLLBARS_INSIDE_OVERLAY);
	      browser.loadUrl(url);  
	}
	      

	   private class MyBrowser extends WebViewClient {
	      @Override
	      public boolean shouldOverrideUrlLoading(WebView view, String url) {
	         view.loadUrl(url);
	         return true;
	      }
	   }
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub

	}

	public void onProviderEnabled(String provider) {
		Toast.makeText(this, "Enabled new provider " + provider,
				Toast.LENGTH_SHORT).show();

	}

	public void onProviderDisabled(String provider) {
		Toast.makeText(this, "Disabled provider " + provider,
				Toast.LENGTH_SHORT).show();
	}


	@Override
	public void onLocationChanged(Location location) {
		// TODO Auto-generated method stub
		
	}

}
