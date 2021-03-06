<?php
namespace ImiApp\Module\Gobang\Model;

use Imi\Model\RedisModel;
use Imi\Aop\Annotation\Inject;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\RedisEntity;
use ImiApp\Module\Gobang\Enum\GobangStatus;

/**
 * 房间模型
 * 
 * @RedisEntity(storage="hash", key="imi:gobang:rooms", member="{roomId}")
 */
class RoomModel extends RedisModel
{
    /**
     * @Inject("MemberService")
     *
     * @var \ImiApp\Module\Member\Service\MemberService
     */
    protected $memberService;

    /**
     * 房间id
     *
     * @Column
     *
     * @var int
     */
    protected $roomId;

    /**
     * 创建者ID
     *
     * @Column
     *
     * @var int
     */
    protected $creatorId;

    /**
     * 玩家1
     *
     * @Column
     * 
     * @var int
     */
    protected $playerId1 = 0;

    /**
     * 玩家1是否准备
     *
     * @Column
     *
     * @var bool
     */
    protected $player1Ready = false;

    /**
     * 玩家2
     *
     * @Column
     *
     * @var int
     */
    protected $playerId2 = 0;

    /**
     * 玩家2是否准备
     *
     * @Column
     *
     * @var bool
     */
    protected $player2Ready = false;

    /**
     * 状态
     *
     * @Column
     *
     * @var int
     */
    protected $status = GobangStatus::WAIT_START;

    /**
     * 房间标题
     *
     * @Column
     *
     * @var string
     */
    protected $title;

    /**
     * 创建者名称
     * 
     * @Column
     *
     * @var string
     */
    protected $creator;

    /**
     * 人数
     * 
     * @Column
     *
     * @var int
     */
    protected $person;

    /**
     * 状态文本
     * 
     * @Column
     *
     * @var string
     */
    protected $statusText;

    /**
     * 玩家1信息
     * 
     * @Column
     *
     * @var \ImiApp\Module\Member\Model\Member
     */
    protected $player1;

    /**
     * 玩家2信息
     * 
     * @Column
     *
     * @var \ImiApp\Module\Member\Model\Member
     */
    protected $player2;

    /**
     * 观战用户列表
     * 
     * @Column
     *
     * @var array
     */
    protected $watchMemberIds = [];

    /**
     * 观战用户信息列表
     * 
     * @Column
     *
     * @var array
     */
    protected $watchMemberInfos = [];

    /**
     * Get 玩家1
     *
     * @return int
     */ 
    public function getPlayerId1()
    {
        return $this->playerId1;
    }

    /**
     * Set 玩家1
     *
     * @param int $playerId1  玩家1
     *
     * @return self
     */ 
    public function setPlayerId1(int $playerId1)
    {
        $this->playerId1 = $playerId1;

        return $this;
    }

    /**
     * Get 玩家1是否准备
     *
     * @return bool
     */ 
    public function getPlayer1Ready()
    {
        return $this->player1Ready;
    }

    /**
     * Set 玩家1是否准备
     *
     * @param bool $player1Ready  玩家1是否准备
     *
     * @return self
     */ 
    public function setPlayer1Ready(bool $player1Ready)
    {
        $this->player1Ready = $player1Ready;

        return $this;
    }

    /**
     * Get 玩家2
     *
     * @return int
     */ 
    public function getPlayerId2()
    {
        return $this->playerId2;
    }

    /**
     * Set 玩家2
     *
     * @param int $playerId2  玩家2
     *
     * @return self
     */ 
    public function setPlayerId2(int $playerId2)
    {
        $this->playerId2 = $playerId2;

        return $this;
    }

    /**
     * Get 玩家2是否准备
     *
     * @return bool
     */ 
    public function getPlayer2Ready()
    {
        return $this->player2Ready;
    }

    /**
     * Set 玩家2是否准备
     *
     * @param bool $player2Ready  玩家2是否准备
     *
     * @return self
     */ 
    public function setPlayer2Ready(bool $player2Ready)
    {
        $this->player2Ready = $player2Ready;

        return $this;
    }

    /**
     * Get 状态
     *
     * @return int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set 状态
     *
     * @param int $status  状态
     *
     * @return self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get 房间id
     *
     * @return int
     */ 
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set 房间id
     *
     * @param int $roomId  房间id
     *
     * @return self
     */ 
    public function setRoomId(int $roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get 房间标题
     *
     * @return string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set 房间标题
     *
     * @param string $title  房间标题
     *
     * @return self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get 创建者ID
     *
     * @return int
     */ 
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * Set 创建者ID
     *
     * @param int $creatorId  创建者ID
     *
     * @return self
     */ 
    public function setCreatorId(int $creatorId)
    {
        $this->creatorId = $creatorId;

        return $this;
    }

    /**
     * Get 创建者名称
     *
     * @return string
     */ 
    public function getCreator()
    {
        return $this->memberService->get($this->creatorId);
    }

    /**
     * Get 人数
     *
     * @return int
     */ 
    public function getPerson()
    {
        $person = 0;
        if($this->playerId1 > 0)
        {
            ++$person;
        }
        if($this->playerId2 > 0)
        {
            ++$person;
        }
        return $person;
    }

    /**
     * Get 状态文本
     *
     * @return string
     */ 
    public function getStatusText()
    {
        return GobangStatus::getText($this->status);
    }

    /**
     * Get 玩家1信息
     *
     * @return \ImiApp\Module\Member\Model\Member
     */ 
    public function getPlayer1()
    {
        return $this->playerId1 > 0 ? $this->memberService->get($this->playerId1) : null;
    }

    /**
     * Get 玩家2信息
     *
     * @return \ImiApp\Module\Member\Model\Member
     */ 
    public function getPlayer2()
    {
        return $this->playerId2 > 0 ? $this->memberService->get($this->playerId2) : null;
    }

    /**
     * Get 观战用户列表
     *
     * @return array
     */ 
    public function &getWatchMemberIds()
    {
        return $this->watchMemberIds;
    }

    /**
     * Set 观战用户列表
     *
     * @param array $watchMemberIds  观战用户列表
     *
     * @return self
     */ 
    public function setWatchMemberIds(array $watchMemberIds)
    {
        $this->watchMemberIds = $watchMemberIds;

        return $this;
    }

    /**
     * Get 观战用户信息列表
     *
     * @return array
     */ 
    public function getWatchMemberInfos()
    {
        if(null !== $this->watchMemberInfos)
        {
            return $this->watchMemberInfos;
        }
        $result = [];
        foreach($this->watchMemberIds as $memberId)
        {
            $result[] = $this->memberService->get($memberId);
        }
        return $this->watchMemberInfos = $result;
    }
}
