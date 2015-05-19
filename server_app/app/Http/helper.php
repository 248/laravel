<?php
// app/Http/helper.php

function delete_form($urlParams, $label = '削除') {
	$form = Form::open(['method' => 'DELETE', 'url' => $urlParams]);

	$form .= Form::submit($label, ['class' => 'btn btn-danger']);

	return $form .= Form::close();
}