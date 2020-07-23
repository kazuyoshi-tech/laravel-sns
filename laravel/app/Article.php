<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Ralations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // public function image (Request $request ,Board $board)
	// {
	// 	$image_name = uniqid(mt_rand(), true);
	// 	$image_name .= '.' . substr(strrchr($_FILES['image_file']['name'], '.'), 1);
	// 	$this->validate($request, [
	// 		'image_file' => [
	// 			'required',
	// 			'file',
	// 			'image',
	// 			'mimes:jpeg,png',
	// 			#'dimensions:min_width=50,min_height=50,max_width=2000,max_height=2000',
	// 		]
	// 	]);

	// 	if ($request->file('image_file')->isValid([])) {
	// 		$image_name = $request->image_file->store('public');
	// 		$board->image = basename($image_name);
	// 		$board->save();
	// 		return redirect()->route('boards.show', ['board' => $board])->with('info_massage', '画像を保存しました。');
	// 	} else {
	// 		return redirect()->route('boards.show', ['board' => $board])->with('info_massage', '.jpgもしくは.pngのみ保存できます。');
	// 	};
	// }

}
