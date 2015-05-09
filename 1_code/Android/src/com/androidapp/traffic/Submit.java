package com.androidapp.traffic;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Locale;

import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Color;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.speech.tts.TextToSpeech;
import android.speech.tts.TextToSpeech.OnInitListener;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;

public class Submit extends Activity implements OnInitListener,LocationListener{
	protected static final int REQUEST_TYPE = 1;
	protected static final int CONFIRM1=2;
	protected static final int POLICE_AMOUNT = 3;
	protected static final int CONFIRM2=4;

	protected static final int TYPES_LIST = 20;

	boolean started;
	boolean tryingtoload;
	double latitude;
	double longitude;
    private TextToSpeech tts;
    String reporttype;
    String policeAmount;
    String road;
    LocationManager locationManager;
	Location location;
	String currentLocation;
	String provider;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		//setContentView(R.layout.report);
		
		
		started=false;
		tts = new TextToSpeech(this, this);
		
		 // Getting LocationManager object from System Service LOCATION_SERVICE
        locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);

       // Creating a criteria object to retrieve provider
       Criteria criteria = new Criteria();

       // Getting the name of the best provider
       provider = locationManager.getBestProvider(criteria, true);

       // Getting Current Location
       location = locationManager.getLastKnownLocation(provider);


       if(location!=null){
           onLocationChanged(location);
       }
		
		reporttype="";
		policeAmount="none";
		road="";
		
		if (!tts.isSpeaking()) {
        	tts.speak("What is your report type?", TextToSpeech.QUEUE_FLUSH, null);
        }
		started=true;
		 while(tts.isSpeaking());
         Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
         i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
        	 try {
        		 if(started)
             startActivityForResult(i, CONFIRM1);
         } catch (Exception e) {
        	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
         }  
		
	}

		


	@Override
	public void onInit(int code) {
		if (code==TextToSpeech.SUCCESS) {
		    tts.setLanguage(Locale.getDefault());
		} else {
			tts = null;
				Toast.makeText(this, "Failed to initialize TTS engine.",
				Toast.LENGTH_SHORT).show();
		}	}

	@Override
	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
	        super.onActivityResult(requestCode, resultCode, data);
	        if (requestCode==REQUEST_TYPE  && resultCode==RESULT_OK) {
	           	 //	Toast.makeText(this, address, Toast.LENGTH_LONG).show();
		ArrayList<String> thingsYouSaid = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
		reporttype=thingsYouSaid.get(0);
        		
        			

	                    if (!tts.isSpeaking()) {
	                    	tts.speak("Say yes if this is your report type: "+reporttype, TextToSpeech.QUEUE_FLUSH, null);
	                    }
	                    while(tts.isSpeaking());
	                    Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
	                    i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
	                   	 try {
	                		 if(started)

	                        startActivityForResult(i, CONFIRM1);
	                    } catch (Exception e) {
	                   	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
	                    }   
		            
	        }else if(requestCode==CONFIRM1  && resultCode==RESULT_OK){
        		ArrayList<String> thingsYouSaid = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
        		
        		if(thingsYouSaid.get(0).toLowerCase().equals("yes")){
        				if(reporttype.toLowerCase().equals("police report")){
             			   if (!tts.isSpeaking()) {
   	                    	tts.speak("What is the police amount: one, two, three, or more?", TextToSpeech.QUEUE_FLUSH, null);
   		                    while(tts.isSpeaking());
   		                    Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
   		                    i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
   		                   	 try {
   		             		 if(started)

   		                        startActivityForResult(i, POLICE_AMOUNT);
   		                    } catch (Exception e) {
   		                   	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
   		                    }  
        					   
        				   }
	                    }else{
	             		  finishReport();                   	
	                    }
        		}else{
        			
        			if (!tts.isSpeaking()) {
        	        	tts.speak("Please say your report type.", TextToSpeech.QUEUE_FLUSH, null);
        	        }
        			
        			 while(tts.isSpeaking());
        	         Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
        	         i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
        	        	 try {
        	        		 if(started)

        	             startActivityForResult(i, REQUEST_TYPE);
        	         } catch (Exception e) {
        	        	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
        	         } 
        			
        		}
	        }else if(requestCode==POLICE_AMOUNT  && resultCode==RESULT_OK){
        		ArrayList<String> thingsYouSaid = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
        		policeAmount=thingsYouSaid.get(0).toLowerCase();
        		if(thingsYouSaid.get(0).toLowerCase().equals("one")||
        				thingsYouSaid.get(0).toLowerCase().equals("two")||
        				thingsYouSaid.get(0).toLowerCase().equals("to")||
        				thingsYouSaid.get(0).toLowerCase().equals("too")||
        				thingsYouSaid.get(0).toLowerCase().equals("three")||
        				thingsYouSaid.get(0).toLowerCase().equals("more")||
        				thingsYouSaid.get(0).toLowerCase().equals("1")||
        				thingsYouSaid.get(0).toLowerCase().equals("2")||
        				thingsYouSaid.get(0).toLowerCase().equals("3")){
        			  if (!tts.isSpeaking()) {
	                    	tts.speak("Say yes if this is your police amount: "+policeAmount, TextToSpeech.QUEUE_FLUSH, null);
	                    }
	                    while(tts.isSpeaking());
	                    Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
	                    i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
	                   	 try {
	                		 if(started)

	                        startActivityForResult(i, CONFIRM2);
	                    } catch (Exception e) {
	                   	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
	                    }  
        		}else{
      			  if (!tts.isSpeaking()) {
                  	tts.speak("Error: police amount needs to be one, two, three, or more. Please say amount again.", TextToSpeech.QUEUE_FLUSH, null);
                  }
                  while(tts.isSpeaking());
                  Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
                  i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
                 	 try {
                		 if(started)

                      startActivityForResult(i, POLICE_AMOUNT);
                  } catch (Exception e) {
                 	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
                  } 	
        		}
    		}else if(requestCode==CONFIRM2  && resultCode==RESULT_OK){
    			ArrayList<String> thingsYouSaid = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
        		if(thingsYouSaid.get(0).toLowerCase().equals("yes")){
        				
        			
        			if(policeAmount.equals("1"))policeAmount="one";
        			else if(policeAmount.equals("2")||policeAmount.equals("to"))policeAmount="two";
        			else if(policeAmount.equals("3")) policeAmount="three";
	             		  finishReport();                   	
	                    
        		}else{
        			
        			if (!tts.isSpeaking()) {
        	        	tts.speak("Please say amount again.", TextToSpeech.QUEUE_FLUSH, null);
        	        }
        			
        			 while(tts.isSpeaking());
        	         Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
        	         i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
        	        	 try {
        	        		 if(started)

        	             startActivityForResult(i, POLICE_AMOUNT);
        	         } catch (Exception e) {
        	        	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
        	         } 
        		}
    		}else if(requestCode==TYPES_LIST  && resultCode==RESULT_OK){
    			
        			
    			if (!tts.isSpeaking()) {
    	        	tts.speak("Here are the following types:"
    	        			+ "Pothole,"
    	        			+ "accident,"
    	        			+ "natural blockage,"
    	        			+ "construction,"
    	        			+ "event,"
    	        			+ "traffic,"
    	        			+ "police report,"
    	        			+ "scenic route,"
    	        			+ "or other. Please say the report type.", TextToSpeech.QUEUE_FLUSH, null);
    	        }
    			
    			 while(tts.isSpeaking());
    	         Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
    	         i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
    	        	 try {
    	        		 if(started)

    	             startActivityForResult(i, REQUEST_TYPE);
    	         } catch (Exception e) {
    	        	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
    	         } 
    		

	    }
	        
	}
	
	
	private void finishReport(){
		WebView browser;
		String other="";
		String tempreporttype=reporttype.toLowerCase();

		//switch(tempreporttype){
			if (tempreporttype.equals("pothole"))reporttype="Pothole";
			else if (tempreporttype.equals( "accident"))reporttype="Accident";
			else if (tempreporttype.equals( "natural blockage"))reporttype="Natural+Blockage";
			else if (tempreporttype.equals( "construction"))reporttype="Construction";
			else if (tempreporttype.equals( "event"))reporttype="Event";
			else if (tempreporttype.equals( "traffic"))reporttype="Traffic";
			else if (tempreporttype.equals( "police report"))reporttype="Police+Sighting";
			else if (tempreporttype.equals( "scenic route"))reporttype="Scenic+Route";
			else {
				other=reporttype;
				reporttype="Other";
			}
		
		tryingtoload=true;
			
		 browser = new WebView(this);
	        browser.setWebViewClient(new MyBrowser());
		      String url = "http://m.justincoding.com/trafficProject/include/police_user_report_page.php";
		      url=url+"?LatCoords="
		      		+ latitude
		      		+ "&LongCoords="
		      		+ longitude
		      		+ "&reporttype="
		      		+ reporttype
		      		+ "&other="
		      		+ other
		      		+ "&policeamount="
		      		+ policeAmount
		      		+ "&roadname=";
		      Log.d("bluh",url);
		      browser.getSettings().setLoadsImagesAutomatically(true);
		      browser.getSettings().setJavaScriptEnabled(true);
		      browser.addJavascriptInterface(new LoadListener(), "HTMLOUT");
		      browser.setScrollBarStyle(View.SCROLLBARS_INSIDE_OVERLAY);
		      browser.loadUrl(url);  
	
			   
	}



		private class LoadListener{
		    public void processHTML(String html)
		    {
		        Log.e("result",html);
		    }
		}
	
	   private class MyBrowser extends WebViewClient {
	      @Override
	      public boolean shouldOverrideUrlLoading(WebView view, String url) {
	         view.loadUrl(url);
	         return true;
	      }
	      
	      @Override
	      public void onPageFinished(WebView view, String url){
	         //   view.loadUrl("javascript:");
				if(tryingtoload){
					String javascript= "javascript:(function(){"
							+ "document.getElementsByClassName('styled-button-5')[0].click();"
							+ "window.HTMLOUT.processHTML(document.getElementsByTagName('br')[document.getElementsByTagName('br').length-1].innerHTML);"
							+ "})();";
	    	  view.loadUrl(javascript);
	    	  tryingtoload=false;
				}
	    	  
	      }
	      
//			@Override
//	        public void onPageFinished(WebView view, String url) {
//				if(tryingtoload){
//				     String javascript="javascript: (function(){"
//								+"document.getElementById('startingAddress').value='"
//								+ latitude+", "+longitude
//								+ "';"
//								+"document.getElementById('destinationAddress').value='"
//								+ endaddress
//								+ "';"
//								+ "calcRoute();"
//								+ "})()";
//				    view.loadUrl(javascript);
//					tryingtoload=false;
//					initload=false;
//				}
//	        }
	   }
			
			 


	@Override
	public void onLocationChanged(Location location) {
		// TODO Auto-generated method stub
		
		// Getting latitude of the current location
		latitude = location.getLatitude()+1;
		
		// Getting longitude of the current location
		longitude = location.getLongitude();		
	}




	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub
		
	}




	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub
		
	}




	@Override
	public void onProviderDisabled(String provider) {
		// TODO Auto-generated method stub
		
	}

}
