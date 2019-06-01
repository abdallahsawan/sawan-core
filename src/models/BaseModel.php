<?php

namespace Sawan\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Sawan\Core\Utils\AttachmentUtils;

class BaseModel extends Model
{
    protected $appends = ['attachments'];
    protected $with = ['creator', 'last_modifier'];
    public function __construct()
    {
        parent::__construct();
        $this->fillable = array_merge($this->fillable, array("attachments"));
        $this->entity_type = strtoupper(class_basename($this));
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if($model->isNewInstance()) {
                $model->creator = Auth::id();
            }
            $model->last_modifier = Auth::id();
        });
        static::saved(function ($model) {
            AttachmentUtils::updateAttachments($model);
        });
        static::deleting(function ($model) {
            AttachmentUtils::deleteAllAttachments($model);
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }
    public function last_modifier()
    {
        return $this->belongsTo(User::class, 'last_modifier');
    }
    public function getAttachmentsAttribute() {
        if(property_exists ($this, 'attachments')) {
            return $this->attachments == null ?
                Attachment::where('owner_type', $this->entity_type)->where('owner_id', $this->id)->get() : $this->attachments;
        } else {
            return Attachment::where('owner_type', $this->entity_type)->where('owner_id', $this->id)->get();
        }
    }

    public function setAttachmentsAttribute($attachments)
    {
        //dd($attachments);
        $this->attachments = new Collection();
        foreach ($attachments as $attachment) {
            $attachment = Attachment::find($attachment['id']);
            if ($attachment != null) {
                $this->attachments->push($attachment);
            }
        }
    }
    public function isNewInstance() {
        return $this->id == null;
    }
}

