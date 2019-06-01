<?php


namespace Sawan\Core\Utils;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Sawan\Core\Models\Attachment;
use Sawan\Core\Models\BaseModel;


class AttachmentUtils
{

    public static function getAttachments(BaseModel $model)
    {
        return ($model->id != null && $model->entity_type != null) ?
            Attachment::where('owner_type', $model->entity_type)->where('owner_id', $model->id)->get() : new Collection();
    }

    public static function updateAttachments(BaseModel $model)
    {
        $oldAttachments = self::getAttachments($model);
        $modelAttachments = $model->getAttachmentsAttribute();
        self::deleteOldAttachments($oldAttachments, $modelAttachments);
        if ($modelAttachments != null) {
            foreach ($modelAttachments as $attachment) {
                if (!self::binded($model, $attachment)) {
                    self::bindAttachment($model, $attachment);
                }
            }
            $model->attachments = self::getAttachments($model);
        }
    }

    private static function binded(BaseModel $model, Attachment $attachment)
    {
        if ($model->entity_type != null && $model->id != null && $attachment->owner_type != null && $attachment->owner_id != null) {
            return $attachment->owner_type == $model->entity_type && $attachment->owner_id == $model->id;
        } else {
            return false;
        }
    }

    private static function bindAttachment(BaseModel $model, $attachment)
    {
        if ($attachment == null || self::binded($model, $attachment)) {
            return null;
        } else {
            $binded = $attachment->owner_id != null;
            $relativePath = $model->entity_type . "/" . $model->id . "/" . $attachment->id . "." . $attachment->extension;
            if ($binded) {
                $attachment = $attachment->clone();
                $attachment->save();
                $relativePath = $model->entity_type . "/" . $model->id . "/" . $attachment->id . "." . $attachment->extension;
                Storage::disk('public')->copy($attachment->path, $relativePath);
            } else {
                Storage::disk('public')->move($attachment->path, $relativePath);
            }
            $attachment->path = $relativePath;
            $attachment->owner_type = $model->entity_type;
            $attachment->owner_id = $model->id;
            $attachment->save();
            return $attachment;
        }
    }
    private static function deleteOldAttachments($oldAttachments, $modelAttachments)
    {
        foreach ($oldAttachments as $oldAttachment) {
            $deleted = true;
            foreach ($modelAttachments as $modelAttachment) {
                if($oldAttachment->id == $modelAttachment->id) {
                    $deleted = false;
                    break;
                }
            }
            if($deleted) {
                self::resetAttachment($oldAttachment);
            }
        }
    }
    private static function resetAttachment($attachment) {
        $attachment->owner_type = null;
        $attachment->owner_id = null;
        $path = 'attachments/' . $attachment->name . "_" . Carbon::now()->timestamp . "." . $attachment->extension;
        Storage::disk('public')->move($attachment->path, $path);
        $attachment->path = $path;
        $attachment->save();
    }

    public static function deleteAllAttachments($model) {
        $attachments = self::getAttachments($model);
        foreach ($attachments as $attachment) {
            self::resetAttachment($attachment);
        }
    }
}
