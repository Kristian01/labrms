<?php

class RoomInventory extends Eloquent{
	use SoftDeletingTrait;
	protected $table = 'roominventory';
	protected $dates = ['deleted_at'];
	public $timestamps = true;
	public $fillable = ['room_id','item_id'];
	protected $primary = null;

	public static $rules = [
		'Item' => 'required|exists:itemprofile,id',
		'Room' => 'required|exists:room,id'
	];

	public static $updateRules = [
		'Item' => 'exists:itemprofile,id',
		'Room' => 'exists:room,id'
	];

	public static function data_null($location,$id){
		$room = Room::where('name','=',$location)->first();
		Roominventory::create([
			'room_id' => $room->id,
			'item_id' => $id
		]);
	}

	public function room()
	{
		return $this->belongsTo('room','room_id','id');
	}

	public function pc()
	{
		return $this->belongsTo('pc','item_id','id');
	}

}
