package {
	import flash.display.*;
	import flash.events.*;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.text.TextField;
	import gs.TweenMax;
	import flash.utils.Timer;
	public class Peter_Slideshow extends MovieClip {

		private var _urlLoader:URLLoader;
		private var _xml:XML;
		private var _currentIndex:int = 0;
		private var _totalItems:int;
		private var _ldr:Loader = new Loader();
		private var _bmp:Bitmap = new Bitmap();
		private var _timer :Timer = new Timer(5000, 0);
		public function Peter_Slideshow() {
			trace("OK11111");
			_urlLoader = new URLLoader();
			_urlLoader.addEventListener(Event.COMPLETE , uplLoaderCompleteHandler);
			_urlLoader.load(new URLRequest("./cms/template/cervival/xml_data.xml"));
		}
		private function uplLoaderCompleteHandler(e:Event):void {
			_xml = new XML(_urlLoader.data);
			createSlideShow();
		}
		private function createSlideShow():void {

			_ldr.contentLoaderInfo.addEventListener(Event.COMPLETE , loaderCompleteHandler);
			_totalItems = _xml.item.length();
			loadImage(_currentIndex);
		}
		private function onTimer(e:TimerEvent):void {
			loadImage(_currentIndex+1);
		}

		private function loaderCompleteHandler(e:Event):void {
			_timer.addEventListener(TimerEvent.TIMER, onTimer);
			_timer.start();
			container_mc.addChild(_ldr);
			_ldr.alpha = 0;
			TweenMax.to(_ldr, 3, { alpha:1}   );
		}
		private function loadImage(pID:int):void {
			_currentIndex = pID;
			if (_currentIndex > _totalItems - 1) {
				_currentIndex = 0;
			}
			if (_ldr.width > 0) {
				container_mc.addChild(_bmp);
				_bmp.alpha = 1;
				_bmp.bitmapData = new BitmapData(_ldr.width,_ldr.height);
				_bmp.bitmapData.draw(_ldr);
				TweenMax.to(_bmp, 1, { alpha:0 } );
			}
			var _imgURL:String = _xml.item[_currentIndex].img;
			_ldr.load(new URLRequest(_imgURL));

		}
	}
}