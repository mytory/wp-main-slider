<?php
if (!function_exists('attr_checked')) {
	/**
	 * input:checkbox나 input:radio 에서 값을 비교해 checked를 출력.
	 * @param  string $form_value 현재 input의 value
	 * @param  string|array $db_value DB에 저장된 값 혹은 값들의 배열
	 * @param  boolean $default 이게 true면, $db_value가 빈 값일 때 checked를 출력
	 * @return boolean
	 */
	function attr_checked($form_value, $db_value, $default = false)
	{
		if ($default and empty($db_value)) {
			echo 'checked';
		} else if (is_equal_or_in($form_value, $db_value)) {
			echo 'checked';
		}
	}

}

if (!function_exists('attr_selected')) {
	/**
	 * selectbox 에서 값을 비교해 selected를 출력.
	 *
	 * @param string       $form_value 현재 select > option의 value
	 * @param string|array $db_value   DB에 저장된 값 혹은 값들의 배열
	 * @param boolean      $default    이게 true면, $db_value가 빈 값일 때 selected를 출력
	 *
	 * @return boolean
	 */
	function attr_selected( $form_value, $db_value, $default = false ) {
		if ( $default and empty( $db_value ) ) {
			echo 'selected';
		} elseif ( is_equal_or_in( $form_value, $db_value ) ) {
			echo 'selected';
		}
	}
}


if (!function_exists('is_equal_or_in')) {
	/**
	 * input:checkbox, input:radio, select 에서, 현재 값을 표시해 줄 때, 현재 값이 저장된 값과 같은지
	 * 혹은 저장된 값들 중에 포함돼 있는지(checkbox의 경우) 확인하는 함수.
	 * HTML 길이를 줄이기 위해 만든 거다.
	 *
	 * @param string       $form_value 현재 input의 value
	 * @param string|array $db_value   DB에 저장된 값 혹은 값들의 배열
	 *
	 * @return boolean
	 */
	function is_equal_or_in( $form_value, $db_value ) {
		if ( is_array( $db_value ) ) {
			return in_array( $form_value, $db_value );
		} else {
			return $form_value == $db_value;
		}
	}
}