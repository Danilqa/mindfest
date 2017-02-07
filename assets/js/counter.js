$.fn.bs_countdown_timer = function(){
	return this.each(function() {
		var counter = $(this);
		counter.append(
			$('<div class="row bs-countdown-timer">').append(
				$('<div class="col-xs-3">').append(
					$('<div class="numcard">').append(
						$('<span class="numcard-number days">'),
						$('<span class="numcard-desc">').text('Дней')
					)
				),
				$('<div class="col-xs-3">').append(
					$('<div class="numcard">').append(
						$('<span class="numcard-number hours">'),
						$('<span class="numcard-desc">').text('Часов')
					)
				),
				$('<div class="col-xs-3">').append(
					$('<div class="numcard">').append(
						$('<span class="numcard-number mins">'),
						$('<span class="numcard-desc">').text('Минут')
					)
				),
				$('<div class="col-xs-3">').append(
					$('<div class="numcard">').append(
						$('<span class="numcard-number secs">'),
						$('<span class="numcard-desc">').text('Секунд')
					)
				)
			)
		);
		var counter_days = counter.find('.days');
		var counter_hours = counter.find('.hours');
		var counter_mins = counter.find('.mins');
		var counter_secs = counter.find('.secs');
		var target_date = new Date(counter.attr('data-date')).getTime();

		function auto_counter(){
		    var current_date = new Date().getTime();
		    var seconds_left = (target_date - current_date) / 1000;
		    days = parseInt(seconds_left / 86400);
		    seconds_left = seconds_left % 86400;
		    hours = parseInt(seconds_left / 3600);
		    seconds_left = seconds_left % 3600;
		    min = parseInt(seconds_left / 60);
		    sec = parseInt(seconds_left % 60);
		    ms = parseInt(target_date-current_date);
		    
		    hours = hours<10?'0'+hours:hours;
		    min = min<10?'0'+min:min;
		    sec = sec<10?'0'+sec:sec;
			counter_days.text(days);
			counter_hours.text(hours);
			counter_mins.text(min);
			counter_secs.text(sec);
		}
		timeoutInterval = window.setInterval(auto_counter, 300);
	});
}
